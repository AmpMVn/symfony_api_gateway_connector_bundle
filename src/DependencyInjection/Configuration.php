<?php

/**
 * Configuration class.
 */

namespace Rentsoft\ApiGatewayConnectorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('api_gateway_connector');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('frames')->end()
            ->scalarNode('sniff_mimes')->end()
            ->arrayNode('https')->children()
                ->booleanNode('required')->end()
                ->booleanNode('subdomains')->end()
                ->booleanNode('preload')->end()
            ->end()
            ->end()
            ->arrayNode('content')->children()
                ->scalarNode('default')->end()
                ->scalarNode('upgrade_insecure')->end()
                ->scalarNode('styles_inline')->end()
                ->arrayNode('scripts')->scalarPrototype()->end()->end()
                ->arrayNode('styles')->scalarPrototype()->end()->end()
            ->end()
            ->end();


        return $treeBuilder;
    }
}
