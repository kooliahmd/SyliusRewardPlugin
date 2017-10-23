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

namespace SnakeTn\Reward;

use SnakeTn\Reward\DependencyInjection\Compiler\OrderEntityGenerator;
use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RewardPlugin extends Bundle
{
    use SyliusPluginTrait;

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new OrderEntityGenerator());
    }


}
