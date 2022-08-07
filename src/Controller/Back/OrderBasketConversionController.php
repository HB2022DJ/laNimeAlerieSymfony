<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderBasketConversionController extends AbstractController
{
    #[Route('/order/basket/conversion', name: 'app_order_basket_conversion')]
    public function index(): Response
    {
        return $this->render('order_basket_conversion/index.html.twig', [
            'controller_name' => 'OrderBasketConversionController',
        ]);
    }
}
