<?php

namespace OpenOrchestra\BaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AbstractTaggedCompiler
 */
abstract class AbstractTaggedCompiler
{
    /**
     * @param ContainerBuilder $container
     * @param string           $managerName
     * @param string           $tagName
     * @param string           $methodName
     */
    protected function addStrategyToManager(ContainerBuilder $container, $managerName, $tagName, $methodName = 'addStrategy')
    {
        if (!$container->hasDefinition($managerName)) {
            return;
        }

        $manager = $container->getDefinition($managerName);
        $strategies = $container->findTaggedServiceIds($tagName);
        foreach ($strategies as $id => $attributes) {
            $manager->addMethodCall($methodName, array(new Reference($id)));
        }
    }
}
