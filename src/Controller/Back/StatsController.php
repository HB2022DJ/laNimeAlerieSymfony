<?php

namespace App\Controller;

use App\Repository\BasketRepository;
use App\Repository\ItemProductRepository;
use App\Repository\UserRepository;
use App\Repository\VisitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class StatsController extends AbstractController
{
    public function __construct(
        private BasketRepository $basketRepository,
        private VisitRepository $visitRepository,
        private UserRepository  $userRepository,
        private ItemProductRepository $itemProductRepository,
    ) {
    }



    #[Route('/stats', name: 'app_admin_stats')]
    public function stats(): Response
    {

        /**
         *  find number of visit
         *  */
        $numberOfVisits = $this->visitRepository->getNumberVisit();
        $numberOfBaskets = $this->basketRepository->getnumberOfBaskets();
        $numberOfOrders = $this->basketRepository->getnumberOfCommand();

        $convVisitToBasket = round((100 / $numberOfVisits) * $numberOfBaskets, 2);
        $convBasketToOrder = round((100 / ($numberOfBaskets + $numberOfOrders)) * $numberOfOrders, 2);
        $basketsAbandoned = round((100 / ($numberOfBaskets + $numberOfOrders)) * $numberOfBaskets, 2);

        $totalSales = round($this->basketRepository->gettotalSalesAmounts(), 2);
        $averageBaskets = round($totalSales / $numberOfOrders, 2);




        return $this->render('back/stats.html.twig', [
            'controller_name' => 'StatsController',
            'numberbVisits' => $numberOfVisits,
            'NumberBasket' => $numberOfBaskets,
            'NumberCommand' => $numberOfOrders,
            'VisitsBasketsConversion' => $convVisitToBasket,
            'OrderBasketConversion' => $convBasketToOrder,
            'AbandonedBasket' => $basketsAbandoned,
            'TotalSales' => $totalSales,
            'AverageBaskets' => $averageBaskets,


        ]);
    }
}
