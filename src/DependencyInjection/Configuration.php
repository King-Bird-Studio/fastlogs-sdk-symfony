<?php

namespace fastlogs\FastlogsBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('fastlogs');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('slug')->defaultNull()->info('Falstlog service ID')->end()
                ->scalarNode('url')->defaultValue('https://fastlogs-backend.i.kingbird.ru')->info('Falstlog service URL')->end()
                ->arrayNode('channel')->info('Channel Log list')->canBeUnset()->prototype('scalar')->end()->end()
                ->scalarNode('level')->info('Levels Log')->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;
    }

}