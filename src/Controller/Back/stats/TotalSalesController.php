<?php

namespace App\Controller\Back\stats;

use App\Repository\BasketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TotalSalesController extends AbstractController
{
    public function __construct(
        private BasketRepository $basketRepository
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $nbTotalSales = $this->basketRepository->totalSalesAmounts();
        return new JsonResponse(json_encode(['data' => $nbTotalSales]));
    }
}
