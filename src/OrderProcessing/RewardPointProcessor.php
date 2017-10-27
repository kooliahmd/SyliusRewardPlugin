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

namespace SnakeTn\Reward\OrderProcessing;

use Sylius\Component\Order\Factory\AdjustmentFactory;
use Sylius\Component\Order\Factory\AdjustmentFactoryInterface;
use Sylius\Component\Order\Model\OrderInterface;
use Sylius\Component\Order\Processor\OrderProcessorInterface;

class RewardPointProcessor implements OrderProcessorInterface
{

    public function process(OrderInterface $order): void
    {
        $amount = $order->

    }
}