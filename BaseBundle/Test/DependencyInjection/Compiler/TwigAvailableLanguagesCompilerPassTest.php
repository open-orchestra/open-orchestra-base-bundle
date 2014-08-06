<?php

namespace PHPOrchestra\BaseBundle\Test\DependencyInjection\Compiler;

use Phake;
use PHPOrchestra\BaseBundle\DependencyInjection\Compiler\TwigAvailableLanguagesCompilerPass;

/**
 * Class TwigAvailableLanguagesCompilerPassTest
 */
class TwigAvailableLanguagesCompilerPassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TwigAvailableLanguagesCompilerPass
     */
    protected $compiler;

    protected $container;
    protected $twig;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->twig = Phake::mock('Symfony\Component\DependencyInjection\Definition');

        $this->container = Phake::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        Phake::when($this->container)->getDefinition(Phake::anyParameters())->thenReturn($this->twig);

        $this->compiler = new TwigAvailableLanguagesCompilerPass();
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf('Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface', $this->compiler);
    }

    /**
     * Test with no parameters
     */
    public function testWithNoParameters()
    {
        Phake::when($this->container)->has(Phake::anyParameters())->thenReturn(false);

        $this->compiler->process($this->container);

        Phake::verify($this->container)->has('php_orchestra_base.languages.availables');
        Phake::verify($this->twig)->addMethodCall('addGlobal', array(
            'available_languages',
            array('en', 'fr', 'de', 'es')
        ));
    }

    /**
     * @param array $languages
     *
     * @dataProvider provideLanguages
     */
    public function testWithParameters(array $languages)
    {
        Phake::when($this->container)->has(Phake::anyParameters())->thenReturn(true);
        Phake::when($this->container)->getParameter(Phake::anyParameters())->thenReturn($languages);

        $this->compiler->process($this->container);

        Phake::verify($this->container)->has('php_orchestra_base.languages.availables');
        Phake::verify($this->container)->getParameter('php_orchestra_base.languages.availables');
        Phake::verify($this->twig)->addMethodCall('addGlobal', array(
            'available_languages',
            $languages
        ));
    }

    /**
     * @return array
     */
    public function provideLanguages()
    {
        return array(
            array(array('en')),
            array(array('en', 'fr')),
            array(array('en', 'de')),
            array(array('es')),
        );
    }
}
 