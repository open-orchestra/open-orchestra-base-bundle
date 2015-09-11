<?php

namespace OpenOrchestra\BaseBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OpenOrchestraBaseExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('parameters.yml');

        if (count($config['administration_languages']) == 0) {
            $config['administration_languages'] = array('en', 'fr');
        }


        $container->setAlias('object_manager', $config['object_manager']);

        $container->setParameter('open_orchestra_base.administration_languages', $config['administration_languages']);
        $container->setParameter('open_orchestra_base.encryption_key', $config['encryption_key']);
    }
}
