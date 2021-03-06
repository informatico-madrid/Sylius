<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\TranslationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('sylius_translation');

        $this->addMappingDefaults($rootNode);

        return $treeBuilder;
    }

    /*
    * @param ArrayNodeDefinition $node
    */
    private function addMappingDefaults(ArrayNodeDefinition $node)
    {
        $node
            ->children()
            ->arrayNode('default_mapping')
                ->addDefaultsIfNotSet()
                ->children()
                    ->arrayNode('translatable')
                        ->children()
                            ->scalarNode('field')->defaultValue('translations')->end()
                            ->scalarNode('currentLocale')->defaultValue('currentLocale')->end()
                            ->scalarNode('fallbackLocale')->defaultValue('fallbackLocale')->end()
                        ->end()
                    ->end()
                    ->arrayNode('translation')
                        ->children()
                            ->scalarNode('field')->defaultValue('translatable')->end()
                            ->scalarNode('locale')->defaultValue('locale')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
