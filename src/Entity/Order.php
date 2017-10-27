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

namespace SnakeTn\Reward\Entity;

use Sylius\Component\Core\Model\Order as BaseOrder;

class Order extends BaseOrder
{
    private $usedRewardPointMovement;

    public function getUsedRewardPointMovement(): RewardPointMovement
    {
        return $this->usedRewardPointMovement;
    }

    public function setUsedRewardPointMovement($usedRewardPointMovement)
    {
        $this->usedRewardPointMovement = $usedRewardPointMovement;
    }


}