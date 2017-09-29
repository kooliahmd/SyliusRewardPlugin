<?php

/*
 * This file is part of reward plugin for sylius.
 *
 * (c) Ahmed Kooli
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SnakeTn\Reward\CustomerEligibilityChecker;

use Sylius\Component\Customer\Model\CustomerInterface;

interface CustomerEligibilityCheckerInterface
{
    public function check(CustomerInterface $customer);
}
