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

namespace SnakeTn\Reward\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class UsedRewardPointsNumber extends Constraint
{
    public $message = 'reward.used_reward_points.is_invalid';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}