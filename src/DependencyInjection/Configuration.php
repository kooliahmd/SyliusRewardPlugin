<?php

/*
 * This file is part of reward plugin for sylius.
 *
 * (c) Ahmed Kooli
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SnakeTn\Reward\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('reward');

        $rootNode
            ->children()
                ->arrayNode('earned_reward_points')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('for_each_X_spent_get_Y_reward_points')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->integerNode('X')
                                    ->min(0)
                                    ->defaultValue(1)
                                    ->end()
                                ->integerNode('Y')
                                    ->min(0)
                                    ->defaultValue(1)
                                    ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('spent_reward_points')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('for_each_one_point_spent_get_X_discount')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->integerNode('X')
                                ->min(0)
                                ->defaultValue(1)
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}