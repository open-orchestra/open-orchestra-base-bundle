<?php

namespace PHPOrchestra\BaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AbstractTaggedCompiler
 */
abstract class AbstractTaggedCompiler
{
    /**
     * @param ContainerBuilder $container
     * @param $managerName
     * @param $tagName
     */
    protected function addStrategyToManager(ContainerBuilder $container, $managerName, $tagName)
    {
        if (!$container->hasDefinition($managerName)) {
            return;
        }

        $manager = $container->getDefinition($managerName);
        $strategies = $container->findTaggedServiceIds($tagName);
        foreach ($strategies as $id => $attributes) {
            $manager->addMethodCall('addStrategy', array(new Reference($id)));
        }
    }
}
