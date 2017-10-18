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

namespace CustomerEligibilityChecker;

use PHPUnit\Framework\TestCase;
use SnakeTn\Reward\CustomerEligibilityChecker\ByGroupCustomerEligibilityChecker;
use SnakeTn\Reward\CustomerEligibilityChecker\CustomerEligibilityChecker;
use Sylius\Component\Customer\Model\CustomerGroupInterface;
use Sylius\Component\Customer\Model\CustomerInterface;

class CustomerEligibilityCheckerTest extends TestCase
{
    public function test_check()
    {
        $customerEligibilityChecker = new CustomerEligibilityChecker();
        $customerEligibilityChecker->addUnitCustomerEligibilityChecker(new ByGroupCustomerEligibilityChecker(['default'], []));

        $customer = $this->createMock(CustomerInterface::class);

        $customerGroup = $this->createMock(CustomerGroupInterface::class);
        $customerGroup->method('getCode')
            ->willReturn('default');

        $customer->method('getGroup')
            ->willReturn($customerGroup);

        $this->assertTrue($customerEligibilityChecker->check($customer));
    }
}
