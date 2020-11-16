<?php
declare(strict_types = 1);

namespace Jalismrs\Symfony\Bundle\JalismrsProcessBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Jalismrs\Symfony\Bundle\JalismrsProcessBundle\DependencyInjection
 */
class Configuration implements
    ConfigurationInterface
{
    public const CONFIG_ROOT = 'jalismrs_process';
    
    /**
     * getConfigTreeBuilder
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     *
     * @throws \InvalidArgumentException
     */
    public function getConfigTreeBuilder() : TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::CONFIG_ROOT);
        
        // @formatter:off
        $treeBuilder
            ->getRootNode()
            ->children()
                ->integerNode('cap')
                    ->defaultValue(0)
                    ->info('Limit parallel processes. 0 => no limit')
                    ->min(0)
                ->end()
            ->end();
        // @formatter:on
        
        return $treeBuilder;
    }
}
