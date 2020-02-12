<?php

namespace App\Repository;

use App\Entity\ProductState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductState|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductState|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductState[]    findAll()
 * @method ProductState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductState::class);
    }

    // /**
    //  * @return ProductState[] Returns an array of ProductState objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductState
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
