<?php

namespace OpenOrchestra\BaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class TwigGlobalsCompilerPass
 */
class TwigGlobalsCompilerPass implements CompilerPassInterface
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
        if ($container->hasDefinition('twig')) {
            $twig = $container->getDefinition('twig');

            if($container->hasParameter('open_orchestra')) {
                //$twig->addMethodCall('addGlobal', array('open_orchestra', array('version' => '1.1.0')));
                $twig->addMethodCall('addGlobal', array('open_orchestra', $container->getParameter('open_orchestra')));
            }
        }
    }

}
