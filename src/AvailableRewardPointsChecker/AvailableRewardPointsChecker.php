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

namespace SnakeTn\Reward\AvailableRewardPointsChecker;

use SnakeTn\Reward\Repository\RewardPointMovementRepository;
use Sylius\Component\Core\Model\CustomerInterface;

class AvailableRewardPointsChecker
{
    protected $rewardPointMovementRepository;

    public function __construct(RewardPointMovementRepository $rewardPointMovementRepository)
    {
        $this->rewardPointMovementRepository = $rewardPointMovementRepository;
    }

    public function check(CustomerInterface $customer, $requestedRewardPointsToUse): bool
    {
        $activeMovements = $this->rewardPointMovementRepository->findActiveMovementsPerCustomer($customer);

        $availableRewardPointsNumber = 0;
        foreach ($activeMovements as $activeMovement) {
            $availableRewardPointsNumber += $activeMovement->getValue();
        }

        return $availableRewardPointsNumber >= $requestedRewardPointsToUse;
    }
}
