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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

class RewardExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('view_extensions.yml');
        $loader->load('form_type_extensions.yml');
        $loader->load('order_processing_extensions.yml');

        $loader->load('services.yml');

        $this->loadConfiguration($configs, $container);
    }

    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig(
            'winzou_state_machine',
            Yaml::parse(file_get_contents(__DIR__ . '/../Resources/config/state_machine/sylius_order_checkout_extension.yml'))
        );
    }

    private function loadConfiguration($configs, ContainerBuilder $container)
    {
        $processConfiguration = $this->processConfiguration(new Configuration(), $configs);

        $container->getDefinition('reward.fixed_step_reward_points_calculator')
            ->setArgument('$stepAmount', $processConfiguration['earned_reward_points']['for_each_X_spent_get_Y_reward_points']['X'])
            ->setArgument('$numberOfRewardPointsToEarnPerStep', $processConfiguration['earned_reward_points']['for_each_X_spent_get_Y_reward_points']['Y']);
    }


}
