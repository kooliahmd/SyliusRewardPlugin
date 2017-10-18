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

namespace SnakeTn\Reward\CustomerEligibilityChecker;

use Sylius\Component\Customer\Model\CustomerInterface;

class CustomerEligibilityChecker implements CustomerEligibilityCheckerInterface
{
    /**
     * @var CustomerEligibilityCheckerInterface[]
     */
    private $unitCustomerEligibilityCheckers = [];

    public function addUnitCustomerEligibilityChecker(CustomerEligibilityCheckerInterface $customerEligibilityChecker)
    {
        $this->unitCustomerEligibilityCheckers[] = $customerEligibilityChecker;
    }

    public function check(CustomerInterface $customer): bool
    {
        $isEligible = true;
        foreach ($this->unitCustomerEligibilityCheckers as $unitCustomerEligibilityChecker) {
            $isEligible &= !$unitCustomerEligibilityChecker->check($customer);
        }
        return true;
    }
}
