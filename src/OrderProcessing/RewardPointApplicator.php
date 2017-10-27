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


use SnakeTn\Reward\Entity\Order;
use Sylius\Component\Order\Factory\AdjustmentFactoryInterface;

class RewardPointApplicator
{
    const ORDER_REWARD_ADJUSTMENT = 'reward';

    private $adjustmentFactory;

    public function __construct(AdjustmentFactoryInterface $adjustmentFactory)
    {
        $this->adjustmentFactory = $adjustmentFactory;
    }

    public function apply(Order $order): void
    {
        $rewardMovement = $order->getUsedRewardPointMovement();
        $numberOfRewardPoints = $rewardMovement->getValue();
        $amount = $this->exchangeRewardPointsToAmount($numberOfRewardPoints);

        $adjustment = $this->adjustmentFactory->createWithData(self::ORDER_REWARD_ADJUSTMENT, '', $amount);
        $order->addAdjustment($adjustment);
    }

    public function revert(Order $order): void
    {
        $order->removeAdjustments(self::ORDER_REWARD_ADJUSTMENT);
    }

    private function exchangeRewardPointsToAmount(int $numberOfRewardPoints): int
    {
        return -1 * $numberOfRewardPoints;
    }
}
