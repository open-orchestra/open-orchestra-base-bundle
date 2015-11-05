<?php

namespace OpenOrchestra\BaseBundle\Tests\DependencyInjection\Compiler;

use Phake;
use OpenOrchestra\BaseBundle\DependencyInjection\Compiler\TwigGlobalsCompilerPass;


class TwigGlobalsCompilerPassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TwigGlobalsCompilerPass
     */
    protected $compiler;

    protected $container;
    protected $twig;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->compiler = new TwigGlobalsCompilerPass();
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface', $this->compiler);
    }

    /**
     * @param $hasDefinition
     * @param $hasParameters
     *
     * @dataProvider provider
     */
    public function testProcess($hasDefinition, $hasParameters)
    {
        $twig = Phake::mock('Symfony\Component\DependencyInjection\Definition');
        $container = Phake::mock('Symfony\Component\DependencyInjection\ContainerBuilder');

        Phake::when($container)->getDefinition(Phake::anyParameters())->thenReturn($twig);
        Phake::when($container)->hasDefinition(Phake::anyParameters())->thenReturn($hasDefinition);
        Phake::when($container)->hasParameter(Phake::anyParameters())->thenReturn($hasParameters);
        Phake::when($container)->getParameter(Phake::anyParameters())->thenReturn(array('version' => Phake::anyParameters()));

        $tmp = clone $container;

        $this->compiler->process($container);

        if ($hasDefinition) {
            Phake::verify($container)->getDefinition('twig');
            if ($hasParameters) {
                Phake::verify($container)->hasParameter(Phake::anyParameters());
                Phake::verify($twig)->addMethodCall('addGlobal', array('open_orchestra', array('version' => Phake::anyParameters())));
                Phake::verify($container)->getParameter(Phake::anyParameters());
            }
        } else {
            $this->assertEquals($container, $tmp);
        }
    }

    /**
     * @return array
     */
    public function provider()
    {
        return array(
            array(false, false),
            array(true, false),
            array(true, true),
        );
    }
}
