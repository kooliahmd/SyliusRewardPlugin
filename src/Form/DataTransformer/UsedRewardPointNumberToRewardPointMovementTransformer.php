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

namespace SnakeTn\Reward\Form\DataTransformer;

use SnakeTn\Reward\Entity\Order;
use SnakeTn\Reward\Entity\RewardPointMovement;
use Symfony\Component\Form\DataTransformerInterface;

class UsedRewardPointNumberToRewardPointMovementTransformer implements DataTransformerInterface
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function transform($usedRewardPointMouvement)
    {
        //TODO replace if with NullObject pattern
        if (!empty($usedRewardPointMouvement)) {
            return $usedRewardPointMouvement->getValue();
        }
    }

    public function reverseTransform($numberOfRewardPointsToUse)
    {
        $rewardPointMovement = $this->order->getUsedRewardPointMovement();
        //TODO replace if with NullObject pattern
        if (empty($rewardPointMovement)) {
            $rewardPointMovement = new RewardPointMovement();
            $rewardPointMovement->setOrigin(RewardPointMovement::ORDER_CREATION_ORIGIN);
        }
        $rewardPointMovement->setValue($numberOfRewardPointsToUse);
        return $rewardPointMovement;
    }


}
