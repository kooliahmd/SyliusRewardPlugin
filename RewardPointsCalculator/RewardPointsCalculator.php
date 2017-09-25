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

use Webmozart\Assert\Assert;

class RewardPointsCalculator
{
    /**
     * @var RewardPointsCalculatorInterface[]
     */
    private $unitRewardPointsCalculators;

    /**
     * @param float $totalAmount
     * @param array $config
     * @return int
     */
    public function calculate(float $totalAmount, array $config): int
    {
        Assert::isArray($config);
        $rewardPoints = 0;
        foreach ($config as $calculatorConfig) {
            Assert::notEmpty($calculatorConfig['type']);

            $rewardPoints += $this->getUnitRewardPointsCalculatorPerType($calculatorConfig['type'])
                ->calculate($totalAmount, $calculatorConfig);
        }
        return $rewardPoints;
    }

    /**
     * @param $type
     * @return RewardPointsCalculatorInterface
     * @throws \Exception
     */
    private function getUnitRewardPointsCalculatorPerType(string $type): RewardPointsCalculatorInterface
    {
        if (!isset($this->unitRewardPointsCalculators[$type])) {
            throw new \Exception(sprintf('Reward points calculator for %s type is not defined', $type));
        }
        return $this->unitRewardPointsCalculators[$type];
    }

    /**
     * @param string $type
     * @param RewardPointsCalculatorInterface $rewardPointsCalculator
     */
    public function addUnitRewardPointsCalculator(string $type, RewardPointsCalculatorInterface $rewardPointsCalculator): void
    {
        $this->unitRewardPointsCalculators[$type] = $rewardPointsCalculator;
    }

}
