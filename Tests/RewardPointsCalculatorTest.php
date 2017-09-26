<?php
/*
 * This file is part of reward plugin for sylius.
 *
 * (c) Ahmed Kooli
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SnakeTn\Tests;

use PHPUnit\Framework\TestCase;
use SnakeTn\Reward\RewardPointsCalculator\FixedStepRewardPointsCalculator;
use SnakeTn\Reward\RewardPointsCalculator\RewardPointsCalculator;

class RewardPointsCalculatorTest extends TestCase
{
    public function test_calculate()
    {
        $this->assertEquals(90, $this->getRewardPointsCalculator()->calculate(999));
    }


    private function getRewardPointsCalculator()
    {
        $rewardPointsCalculator = new RewardPointsCalculator();
        $rewardPointsCalculator->addUnitRewardPointsCalculator(new FixedStepRewardPointsCalculator(100, 10));
        return $rewardPointsCalculator;
    }
}
