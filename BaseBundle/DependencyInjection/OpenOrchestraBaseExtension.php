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

        $config = array_merge(array(
            'languages_availables' => array('en', 'fr', 'de', 'es')
        ), $config);

        $languagesAvailables = $config['languages_availables'];
        $container->setParameter('open_orchestra_base.languages_availables', $languagesAvailables);

        $container->setParameter('open_orchestra_base.encryption_key', $config['encryption_key']);
    }
}
