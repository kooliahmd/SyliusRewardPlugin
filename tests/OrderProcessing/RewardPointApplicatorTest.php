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

namespace SnakeTn\Reward\Tests\OrderProcessing;

use PHPUnit\Framework\TestCase;
use SnakeTn\Reward\Entity\Order;
use SnakeTn\Reward\Entity\RewardPointMovement;
use SnakeTn\Reward\OrderProcessing\RewardPointApplicator;
use Sylius\Component\Order\Factory\AdjustmentFactory;
use Sylius\Component\Order\Model\Adjustment;
use Sylius\Component\Resource\Factory\FactoryInterface;

class RewardPointApplicatorTest extends TestCase
{

    public function test_apply()
    {
        $order = $this->getOrder();

        $rewardPointApplicator = $this->getRewardPointApplicator();
        $rewardPointApplicator->apply($order);

        $this->assertEquals(-100, $order->getAdjustmentsTotal());
    }

    public function test_revert()
    {
        $order = $this->getOrder();

        $rewardPointApplicator = $this->getRewardPointApplicator();
        $rewardPointApplicator->apply($order);
        $rewardPointApplicator->revert($order);
        $this->assertEquals(0, $order->getAdjustmentsTotal());
    }

    private function getOrder(): Order
    {
        $order = new Order();

        $rewardPointMovement = new RewardPointMovement();
        $rewardPointMovement->setValue(100);
        $order->setUsedRewardPointMovement($rewardPointMovement);
        return $order;
    }

    private function getRewardPointApplicator(): RewardPointApplicator
    {
        $adjustmentFactoryMock = $this->createMock(FactoryInterface::class);
        $adjustmentFactoryMock->method('createNew')
            ->willReturn(new Adjustment());


        $rewardPointApplicator = new RewardPointApplicator(new AdjustmentFactory($adjustmentFactoryMock));
        return $rewardPointApplicator;
    }
}