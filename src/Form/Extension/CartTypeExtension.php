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

namespace SnakeTn\Reward\Form\Extension;

use SnakeTn\Reward\Entity\Order;
use SnakeTn\Reward\Entity\RewardPointMovement;
use Sylius\Bundle\OrderBundle\Form\Type\CartType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CartTypeExtension extends AbstractTypeExtension
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('usedRewardPointMovement', TextType::class);
        $builder->get('usedRewardPointMovement')
            ->addViewTransformer(new CallbackTransformer(

                    function ($usedRewardPointMouvement) {
                        if (!empty($usedRewardPointMouvement)) {
                            return $usedRewardPointMouvement->getValue();
                        }
                    },
                    function ($numberOfRewardPointsToUse) {
                        $rewardPointMovement = $this->order->getUsedRewardPointMovement();
                        if (empty($rewardPointMovement)) {
                            $rewardPointMovement = new RewardPointMovement();
                            $rewardPointMovement->setOrigin(RewardPointMovement::ORDER_CREATION_ORIGIN);
                        }
                        $rewardPointMovement->setValue($numberOfRewardPointsToUse);
                        return $rewardPointMovement;
                    })
            );
    }


    public function getExtendedType()
    {
        return CartType::class;
    }


}
