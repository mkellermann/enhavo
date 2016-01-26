<?php

namespace Enhavo\Bundle\PageBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('enhavo_page');

        $rootNode
            // Driver used by the resource bundle
            ->children()
                ->scalarNode('driver')->defaultValue('doctrine/orm')->end()
            ->end()

            ->children()
                ->booleanNode('dynamic_routing')
                    ->defaultFalse()
                ->end()
            ->end()

            // The resources
            ->children()
                ->arrayNode('classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('page')
                        ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Enhavo\Bundle\PageBundle\Entity\Page')->end()
                                ->scalarNode('controller')->defaultValue('Enhavo\Bundle\PageBundle\Controller\PageController')->end()
                                ->scalarNode('repository')->end()
                                ->scalarNode('form')->defaultValue('Enhavo\Bundle\PageBundle\Form\Type\PageType')->end()
                                ->scalarNode('admin')->defaultValue('Enhavo\Bundle\AppBundle\Admin\BaseAdmin')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()

            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('page')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue('Enhavo\Bundle\PageBundle\Entity\Page')->end()
                                        ->scalarNode('controller')->defaultValue('Enhavo\Bundle\PageBundle\Controller\PageController')->end()
                                        ->scalarNode('repository')->end()
                                        ->scalarNode('factory')->defaultValue('Sylius\Component\Resource\Factory\Factory')->end()
                                        ->arrayNode('form')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('default')->defaultValue('Enhavo\Bundle\PageBundle\Form\Type\PageType')->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()

            ->children()
                ->scalarNode('page_route')->defaultValue(null)->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
