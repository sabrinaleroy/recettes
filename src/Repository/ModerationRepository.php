<?php

namespace App\Repository;

use App\Entity\Moderation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Moderation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Moderation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Moderation[]    findAll()
 * @method Moderation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModerationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Moderation::class);
    }

    // /**
    //  * @return Moderation[] Returns an array of Moderation objects
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
    public function findOneBySomeField($value): ?Moderation
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
