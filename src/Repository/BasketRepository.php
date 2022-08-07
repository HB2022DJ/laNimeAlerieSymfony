<?php

namespace App\Repository;

use App\Entity\Basket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Basket>
 *
 * @method Basket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Basket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Basket[]    findAll()
 * @method Basket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Basket::class);
    }

    public function add(Basket $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Basket $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Basket[] Returns an array of Basket objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Basket
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    // Montant total des commandes payées : panier avec le statut acceptée
    public function gettotalSalesAmounts(): float
    {
        return $this->createQueryBuilder('b')
            ->select('SUM(contain.unitPrice*cointain.quantity)')
            ->join('b.contain', 'contain')
            ->where('b.status = 1')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // Nombre de commandes abouties (payées) : panier avec le statut acceptée
    public function getnumberOfCommand(): int
    {
        return $this->createQueryBuilder('b')
            ->select('COUNT(b)')
            ->where('b.statut = 1')
            ->getQuery()
            ->getSingleScalarResult();
    }


    // Nombre total de paniers : panier avec le statut accepté,en cours de preparation,expédiée
    public function getnumberOfBaskets(): int
    {
        return $this->createQueryBuilder('b')
            ->select('COUNT(b)')
            ->where('b.statut = 1 OR p.statut = 2 OR p.statut = 3')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
