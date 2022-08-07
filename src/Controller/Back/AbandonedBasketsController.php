<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbandonedBasketsController extends AbstractController
{
    #[Route('/abandoned/baskets', name: 'app_abandoned_baskets')]
    public function index(): Response
    {
        return $this->render('abandoned_baskets/index.html.twig', [
            'controller_name' => 'AbandonedBasketsController',
        ]);
    }
}
