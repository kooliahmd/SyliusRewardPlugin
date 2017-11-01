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

namespace SnakeTn\Reward\EarnedRewardPointsProcessing;

use Doctrine\ORM\EntityManagerInterface;
use SnakeTn\Reward\Entity\RewardPointMovement;
use SnakeTn\Reward\Repository\RewardPointMovementRepository;
use SnakeTn\Reward\RewardPointsCalculator\RewardPointsCalculator;
use Sylius\Component\Core\Model\OrderInterface;

class EarnedRewardPointsPersistor
{
    private $rewardPointsCalculator;
    private $entityManager;

    public function __construct(RewardPointsCalculator $rewardPointsCalculator, EntityManagerInterface $entityManager)
    {
        $this->rewardPointsCalculator = $rewardPointsCalculator;
        $this->entityManager = $entityManager;
    }

    public function persist(OrderInterface $order)
    {
        $earnedRewardPoints = $this->rewardPointsCalculator->calculate($order->getTotal());

        if ($earnedRewardPoints === 0) {
            return;
        }

        $rewardPointMovement = new RewardPointMovement();
        $rewardPointMovement->setValue($earnedRewardPoints);
        $rewardPointMovement->setCustomer($order->getCustomer());
        $rewardPointMovement->setOrigin(RewardPointMovement::ORDER_CREATION_ORIGIN);

        $this->entityManager->persist($rewardPointMovement);
        $this->entityManager->flush();
    }

}