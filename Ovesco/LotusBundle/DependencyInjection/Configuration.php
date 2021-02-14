<?php

namespace Ovesco\LotusBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('ovesco_lotus');
        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('geolite')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('db_storage_path')->defaultNull()->end()
                        ->scalarNode('maxmind_license_key')->defaultNull()->end()
                    ->end()
                ->end()
                ->arrayNode('processors')
                    ->scalarPrototype()->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
