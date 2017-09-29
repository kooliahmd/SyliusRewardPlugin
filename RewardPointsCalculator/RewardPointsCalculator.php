<?php

/*
 * This file is part of reward plugin for sylius.
 *
 * (c) Ahmed Kooli
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SnakeTn\Reward\RewardPointsCalculator;

class RewardPointsCalculator
{
    /**
     * @var RewardPointsCalculatorInterface[]
     */
    private $unitRewardPointsCalculators = [];

    public function calculate(int $totalAmount): int
    {
        $rewardPoints = 0;
        foreach ($this->unitRewardPointsCalculators as $unitRewardPointsCalculator) {
            $rewardPoints += $unitRewardPointsCalculator->calculate($totalAmount);
        }
        return $rewardPoints;
    }

    public function addUnitRewardPointsCalculator(RewardPointsCalculatorInterface $rewardPointsCalculator): void
    {
        if (!in_array($rewardPointsCalculator, $this->unitRewardPointsCalculators)) {
            $this->unitRewardPointsCalculators[] = $rewardPointsCalculator;
        }
    }

}
