<?php

namespace OpenOrchestra\BaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class HealthCheckCompilerPass
 */
class HealthCheckCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $managerName = 'open_orchestra_base.health_check';
        $tagName = 'open_orchestra_base.health_check.test';

        if (!$container->hasDefinition($managerName)) {
            return;
        }
        $manager = $container->getDefinition($managerName);
        $tests = $container->findTaggedServiceIds($tagName);

        foreach ($tests as $id => $attributes) {
            $test = $container->getDefinition($id);
            $test->addMethodCall('setHealthCheckResultClass', array($container->getParameter('open_orchestra_base.health_check.test_result.class')));
            $manager->addMethodCall('addTest', array(new Reference($id)));
        }
    }
}
