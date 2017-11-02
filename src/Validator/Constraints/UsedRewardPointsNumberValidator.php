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

use SnakeTn\Reward\CustomerEligibilityChecker\CustomerEligibilityCheckerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UsedRewardPointsNumberValidator extends ConstraintValidator
{
    private $customerEligibilityChecker;

    public function __construct(CustomerEligibilityCheckerInterface $customerEligibilityChecker)
    {
        $this->customerEligibilityChecker = $customerEligibilityChecker;
    }

    public function validate($order, Constraint $constraint)
    {
        /**@var $order OrderInterface */

        if (!$order->getCustomer()) {
            $this->context->addViolation("reward.used_reward_points.customer_is_missing");
        } elseif (!$this->customerEligibilityChecker->check($order->getCustomer())) {
            $this->context->addViolation("reward.used_reward_points.customer_not_eligible");
        }

    }

}