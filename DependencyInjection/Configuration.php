<?php

namespace Sly\PushOverBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration.
 *
 * @uses ConfigurationInterface
 * @author Cédric Dugat <ph3@slynett.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder
            ->root('sly_push_over')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('user_key')
                        ->defaultNull()
                    ->end()
                    ->scalarNode('api_key')
                        ->defaultNull()
                    ->end()
                    ->booleanNode('enabled')
                        ->defaultTrue()
                    ->end()
                    ->arrayNode('pushers')
                        ->useAttributeAsKey('id')
                        ->prototype('array')
                            ->children()
                                ->scalarNode('user_key')
                                    ->cannotBeEmpty()
                                ->end()
                                ->scalarNode('api_key')
                                    ->cannotBeEmpty()
                                ->end()
                                ->scalarNode('device')
                                    ->defaultNull()
                                ->end()
                                ->booleanNode('enabled')
                                    ->defaultTrue()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
