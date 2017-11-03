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

namespace SnakeTn\Reward\Tests\AvailableRewardPointsChecker;

use PHPUnit\Framework\TestCase;
use SnakeTn\Reward\AvailableRewardPointsChecker\AvailableRewardPointsChecker;
use SnakeTn\Reward\Entity\RewardPointMovement;
use SnakeTn\Reward\Repository\RewardPointMovementRepository;
use Sylius\Component\Core\Model\CustomerInterface;

class AvailableRewardPointsCheckerTest extends TestCase
{

    public function test_check()
    {
        $customer = $this->createMock(CustomerInterface::class);
        $rewardPointMovementRepository = $this->createMock(RewardPointMovementRepository::class);

        $rewardPointMovement1 = new RewardPointMovement();
        $rewardPointMovement1->setValue(-100);
        $rewardPointMovement2 = new RewardPointMovement();
        $rewardPointMovement2->setValue(+200);

        $rewardPointMovementRepository->method('findActiveMovementsPerCustomer')
            ->willReturn([$rewardPointMovement1, $rewardPointMovement2]);

        $availableRewardPointsChecker = new AvailableRewardPointsChecker($rewardPointMovementRepository);
        $isAvailable = $availableRewardPointsChecker->check($customer, 100);

        $this->assertTrue($isAvailable);
    }

}
