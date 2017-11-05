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

use SnakeTn\Reward\AvailableRewardPointsChecker\AvailableRewardPointsChecker;
use SnakeTn\Reward\CustomerEligibilityChecker\CustomerEligibilityCheckerInterface;
use SnakeTn\Reward\Entity\Order;
use Sylius\Component\Core\Model\OrderInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UsedRewardPointsNumberValidator extends ConstraintValidator
{
    private $customerEligibilityChecker;
    private $availableRewardPointsChecker;

    public function __construct(
        CustomerEligibilityCheckerInterface $customerEligibilityChecker,
        AvailableRewardPointsChecker $availableRewardPointsChecker
    ) {
        $this->customerEligibilityChecker = $customerEligibilityChecker;
        $this->availableRewardPointsChecker = $availableRewardPointsChecker;
    }

    public function validate($order, Constraint $constraint)
    {
        /**@var $order Order */
        if (!$order->getCustomer()) {
            $this->context->addViolation("reward.used_reward_points.customer_is_missing");
        } elseif (!$this->customerEligibilityChecker->check($order->getCustomer())) {
            $this->context->addViolation("reward.used_reward_points.customer_not_eligible");
        } elseif (!$this->availableRewardPointsChecker->check($order->getCustomer(), $order->getUsedRewardPointMovement())) {
            $this->context->addViolation("reward.used_reward_points.insufficient_available_reward_points");
        }

    }

}
