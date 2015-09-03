<?php

namespace OpenOrchestra\BaseBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('open_orchestra_base');

        $rootNode->children()
            ->scalarNode('object_manager')->defaultValue('doctrine.odm.mongodb.document_manager')->end()
            ->arrayNode('administration_languages')
                ->prototype('scalar')->end()
                ->defaultValue(array('en', 'fr'))
            ->end()
            ->scalarNode('encryption_key')->defaultValue('ThisKeyIsNotSecret')->end()
            ->scalarNode('filter_type_strategy_folder')->defaultValue('vendor/open-orchestra/open-orchestra-libs/OpenOrchestra/Pagination/MongoTrait/FilterTypeStrategy/')->end()
            ->scalarNode('filter_type_strategy_config')->defaultValue('filter_strategy_configuration.yml')->end()
            ->booleanNode('activate_filter_type_strategy')->defaultValue(true)->end()
        ->end();

        return $treeBuilder;
    }
}
