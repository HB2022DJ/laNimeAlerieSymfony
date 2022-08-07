<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NumberOfCommandsController extends AbstractController
{
    #[Route('/number/of/commands', name: 'app_number_of_commands')]
    public function index(): Response
    {
        return $this->render('number_of_commands/index.html.twig', [
            'controller_name' => 'NumberOfCommandsController',
        ]);
    }
}
