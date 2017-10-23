<?php

namespace SnakeTn\Reward\DependencyInjection\Compiler;


use Doctrine\Common\Proxy\Proxy;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OrderEntityGenerator implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
//        $orderClass = $container->getParameter('sylius.model.order.class');
//        Proxy::
    }


}