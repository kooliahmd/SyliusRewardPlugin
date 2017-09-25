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

class FixedStepRewardPointsCalculator implements RewardPointsCalculatorInterface
{
    public function calculate(float $totalAmount, array $config): int
    {
        Assert::isArray($config);
        Assert::numeric($config['step']);

        return (int)($totalAmount/$config[step]) * $config['number_of_rp'];
    }

}
