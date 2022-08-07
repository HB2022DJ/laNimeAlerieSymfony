<?php

namespace App\Controller;

use App\Repository\BasketRepository;
use App\Repository\VisitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisitsBasketsConversionController extends AbstractController
{

    public function __construct(
        EntityManagerInterface $entityManager,
        VisitRepository $visitRepository,
        BasketRepository $basketRepository,
    ) {
        $this->entityManager = $entityManager;
    }


    public function __invoke(): JsonResponse
    {


        $nbVisit = $this->visitRepository->getNumberVisit();
        $nbBasket = $this->basketRepository->getNumberBasketsByStatus();
        $visitToBasket = round((100 / $nbVisit) * $nbBasket, 2);
        return new JsonResponse(['ConversionVisitToBasket' => $visitToBasket]);
    }
}
