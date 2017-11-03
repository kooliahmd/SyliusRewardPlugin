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

use Sylius\Component\Resource\Model\TimestampableTrait;


class RewardPointMovement
{
    const ORDER_CREATION_ORIGIN = 'order_creation';

    const ADMIN_INTERVENTION_ORIGIN = 'admin_intervention';

    use TimestampableTrait;

    private $id;

    private $value;

    private $customer;

    private $origin;

    private $isActive;

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getValue(): int
    {
        //Doctrine is returning string for an int column, it looks relaying on php none typed variables which SUCKS.
        return (int)$this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }


}
