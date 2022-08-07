<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AverageBasketController extends AbstractController
{
    #[Route('/average/basket', name: 'app_average_basket')]
    public function index(): Response
    {
        return $this->render('average_basket/index.html.twig', [
            'controller_name' => 'AverageBasketController',
        ]);
    }
}
