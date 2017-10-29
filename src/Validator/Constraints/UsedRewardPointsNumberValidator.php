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
use Symfony\Component\Validator\ConstraintValidator;

class UsedRewardPointsNumberValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $rewardPointsNumber = $value->getUsedRewardPointMovement()->getValue();
//        if($rewardPointsNumber < $value->getCustomer())
//        $ss = 1;
//        // TODO: Implement validate() method.
    }

}