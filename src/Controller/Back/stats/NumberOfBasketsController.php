<?php

namespace App\Controller\Back\stats;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NumberOfBasketsController extends AbstractController
{
    #[Route('/number/of/baskets', name: 'app_number_of_baskets')]
    public function index(): Response
    {
        return $this->render('number_of_baskets/index.html.twig', [
            'controller_name' => 'NumberOfBasketsController',
        ]);
    }
}
