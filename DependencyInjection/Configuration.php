<?php
namespace Breithbarbot\CropperBundle\DependencyInjection;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('breithbarbot_cropper');
        $rootNode
            ->children()
                ->arrayNode('mappings')
                    ->useAttributeAsKey('id')
                    ->prototype('array')
                        ->children()
                            ->arrayNode('routes')
                                ->isRequired()
                                ->children()
                                    ->scalarNode('add_path')->isRequired()->cannotBeEmpty()->end()
                                    ->scalarNode('remove_path')->end()
                                ->end()
                            ->end()
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
