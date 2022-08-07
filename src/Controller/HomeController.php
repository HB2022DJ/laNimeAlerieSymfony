<?php

namespace App\Controller;

use App\Entity\Visit;
use App\Repository\BasketRepository;
use App\Repository\VisitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    public function __construct(
        private BasketRepository $basketRepository,
        private VisitRepository $visitRepository
    ) {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $visit = new Visit();
        $visit->setDate(new \DateTime('now'));

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
