<?php

/*
 * This file is part of reward plugin for sylius.
 *
 * (c) Ahmed Kooli
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SnakeTn\Tests\RewardPointsCalculator;

use PHPUnit\Framework\TestCase;
use SnakeTn\Reward\RewardPointsCalculator\FixedStepRewardPointsCalculator;

class FixedStepRewardPointsCalculatorTest extends TestCase
{
    public function test_calculate()
    {
        $fixedStepRewardPointsCalculator = new FixedStepRewardPointsCalculator(100, 10);
        $this->assertEquals(90, $fixedStepRewardPointsCalculator->calculate(999));
    }

}
