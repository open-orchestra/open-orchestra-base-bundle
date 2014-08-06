<?php

namespace PHPOrchestra\BaseBundle\Test\Routing;

use Phake;
use PHPOrchestra\BaseBundle\Routing\PhpOrchestraRouter;
use Symfony\Component\Routing\RouteCollection;

/**
 * Tests of PhpOrchestraUrlRouter
 */
class PhpOrchestraRouterTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $cacheService = Phake::mock('PHPOrchestra\CMSBundle\Cache\CacheManagerInterface');
        $nodeRepository = Phake::mock('PHPOrchestra\ModelBundle\Repository\NodeRepository');

        $mockRoutingLoader = Phake::mock('Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader');
        Phake::when($mockRoutingLoader)->load(Phake::anyParameters())->thenReturn(new RouteCollection());

        $container = Phake::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        Phake::when($container)->get('routing.loader')->thenReturn($mockRoutingLoader);
        Phake::when($container)->get('php_orchestra_model.repository.node')->thenReturn($nodeRepository);
        Phake::when($container)->get('php_orchestra_cms.cache_manager')->thenReturn($cacheService);

        $this->router = new PhpOrchestraRouter(
            $container,
            null,
            array(
                'generator_class' => 'PHPOrchestra\BaseBundle\Routing\PhpOrchestraUrlGenerator',
                'generator_base_class' => 'PHPOrchestra\BaseBundle\Routing\PhpOrchestraUrlGenerator',
                'matcher_class' => 'PHPOrchestra\BaseBundle\Routing\PhpOrchestraUrlMatcher',
                'matcher_base_class' => 'PHPOrchestra\BaseBundle\Routing\PhpOrchestraUrlMatcher'
            )
        );
    }
    
    public function testGetMatcher()
    {
        $this->assertInstanceOf(
            'PHPOrchestra\\BaseBundle\\Routing\\PhpOrchestraUrlMatcher',
            $this->router->getMatcher()
        );
    }
    
    public function testGetGenerator()
    {
        $this->assertInstanceOf(
            'PHPOrchestra\\BaseBundle\\Routing\\PhpOrchestraUrlGenerator',
            $this->router->getGenerator()
        );
    }
}
