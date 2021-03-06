<?php

namespace OpenOrchestra\BaseBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class TwigAvailableLanguagesCompilerPass
 */
class TwigAvailableLanguagesCompilerPass implements CompilerPassInterface
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
        $twig = $container->getDefinition('twig');

        $languages = array('en', 'fr');
        if ($container->hasParameter('open_orchestra_base.administration_languages')) {
            $languages = $container->getParameter('open_orchestra_base.administration_languages');
        }

        $twig->addMethodCall('addGlobal', array('administration_languages', $languages));
    }
}
