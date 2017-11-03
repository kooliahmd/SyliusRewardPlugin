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

namespace SnakeTn\Reward\Repository;

use Doctrine\ORM\EntityRepository;
use SnakeTn\Reward\Entity\RewardPointMovement;
use Sylius\Component\Core\Model\CustomerInterface;

class RewardPointMovementRepository extends EntityRepository
{
    /**
     * @param CustomerInterface $customer
     * @return RewardPointMovement[]
     */
    public function findActiveMovementsPerCustomer(CustomerInterface $customer): array
    {
        $query = $this->createQueryBuilder('mouvement')
            ->where('mouvement.isActive = true')
            ->andWhere('mouvement.customer = :customer')
            ->setParameter(':custmer', $customer)
            ->getQuery();

        return $query->getResult();
    }

}
