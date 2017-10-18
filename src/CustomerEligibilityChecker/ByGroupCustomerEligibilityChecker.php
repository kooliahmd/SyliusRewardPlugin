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

class ByGroupCustomerEligibilityChecker implements CustomerEligibilityCheckerInterface
{
    /**
     * @var array
     */
    private $whiteListGroups;

    /**
     * @var array
     */
    private $blackListGroups;

    public function __construct(array $whiteListGroups, array $blackListGroups)
    {
        $this->whiteListGroups = $whiteListGroups;
        $this->blackListGroups = $blackListGroups;
    }

    public function check(CustomerInterface $customer)
    {
        $isEligible = true;
        if ($this->whiteListGroups) {
            $isEligible = $customer->getGroup() && in_array($customer->getGroup(), $this->whiteListGroups);
        }
        if ($this->blackListGroups) {
            $isEligible = $customer->getGroup() && !in_array($customer->getGroup(), $this->blackListGroups);
        }
        return $isEligible;

    }
}
