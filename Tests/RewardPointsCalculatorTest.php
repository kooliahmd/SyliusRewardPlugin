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
        $totalAmount = 999;
        $config = [
            [
                'type' => 'for_each_step_get_x_rp',
                'step' => 100,
                'number_of_rp' => 10,
                'store' => 'US_us'
            ]
        ];
        $this->assertEquals(90, $this->getRewardPointsCalculator()->calculate($totalAmount, $config));
    }

    public function test_calculate_case_calculator_does_not_exist()
    {
        $this->expectException(\Exception::class);
        $totalAmount = 999;
        $config = [
            [
                'type' => 'unexistant_calculator',
                'step' => 100,
                'number_of_rp' => 10,
                'store' => 'US_us'
            ]
        ];
        $this->getRewardPointsCalculator()->calculate($totalAmount, $config);
    }

    private function getRewardPointsCalculator()
    {
        $rewardPointsCalculator = new RewardPointsCalculator();
        $rewardPointsCalculator->addUnitRewardPointsCalculator('for_each_step_get_x_rp', new FixedStepRewardPointsCalculator());
        return $rewardPointsCalculator;
    }
}
