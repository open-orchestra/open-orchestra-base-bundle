<?php

namespace PHPOrchestra\BaseBundle\DependencyInjection\Compiler;

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

        if ($container->has('php_orchestra_base.languages.availables')) {
            $languages = $container->getParameter('php_orchestra_base.languages.availables');
        } else {
            $languages = array('en', 'fr', 'de', 'es');
        }

        $twig->addMethodCall('addGlobal', array('available_languages', $languages));
    }
}
