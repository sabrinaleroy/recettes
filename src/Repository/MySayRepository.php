<?php

namespace App\Repository;

use App\Entity\MySay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MySay|null find($id, $lockMode = null, $lockVersion = null)
 * @method MySay|null findOneBy(array $criteria, array $orderBy = null)
 * @method MySay[]    findAll()
 * @method MySay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MySayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MySay::class);
    }

    // /**
    //  * @return MySay[] Returns an array of MySay objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MySay
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
