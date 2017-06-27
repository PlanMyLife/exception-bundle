<?php

namespace PlanMyLife\ExceptionBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pml_exception');

        $rootNode
            ->children()
                ->scalarNode('class')
                    ->defaultValue('PlanMyLife\ExceptionBundle\Listener\ExceptionListener')
                ->end()
                ->arrayNode('arguments')
                    ->prototype('scalar')
                    ->end()
                ->end()
                ->scalarNode('layout')
                    ->defaultValue('PlanMyLifeExceptionBundle:Error:%s.html.twig')
                ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
