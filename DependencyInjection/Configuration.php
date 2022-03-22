<?php
namespace Breithbarbot\CropperBundle\DependencyInjection;
use RuntimeException;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('breithbarbot_cropper');
        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('mappings')
                    ->useAttributeAsKey('id')
                        ->prototype('array')
                            ->children()
                                ->arrayNode('routes')
                                    ->isRequired()
                                    ->children()
                                        ->scalarNode('path_add')->isRequired()->cannotBeEmpty()->end()
                                        ->scalarNode('path_delete')->end()
                                    ->end()
                                ->end()
                                ->scalarNode('width')->defaultValue(1280)->end()
                                ->scalarNode('height')->defaultValue(720)->end()
                                ->scalarNode('ratio')->defaultValue('16/9')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
