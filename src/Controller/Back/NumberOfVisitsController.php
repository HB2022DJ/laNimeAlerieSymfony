<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NumberOfVisitsController extends AbstractController
{
    #[Route('/number/of/visits', name: 'app_number_of_visits')]
    public function index(): Response
    {
        return $this->render('number_of_visits/index.html.twig', [
            'controller_name' => 'NumberOfVisitsController',
        ]);
    }
}
