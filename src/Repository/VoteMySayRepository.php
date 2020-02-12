<?php

namespace App\Repository;

use App\Entity\VoteMySay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VoteMySay|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoteMySay|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoteMySay[]    findAll()
 * @method VoteMySay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoteMySayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoteMySay::class);
    }

    // /**
    //  * @return VoteMySay[] Returns an array of VoteMySay objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VoteMySay
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
