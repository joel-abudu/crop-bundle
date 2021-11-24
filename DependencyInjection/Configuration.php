<?php
namespace Breithbarbot\CropperBundle\DependencyInjection;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('breithbarbot_cropper');
        $rootNode
            ->children()
                ->arrayNode('config')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('default_folder')->defaultValue('uploads')->cannotBeEmpty()->end()
                        ->scalarNode('data_class')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('mappings')
                    ->useAttributeAsKey('id')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('path')->defaultValue('files/')->end()
                            ->scalarNode('width')->defaultValue(1280)->end()
                            ->scalarNode('height')->defaultValue(720)->end()
                            ->scalarNode('ratio')->defaultValue('16/9')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();
        return $treeBuilder;
    }
}
