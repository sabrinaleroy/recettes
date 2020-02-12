<?php

namespace App\Repository;

use App\Entity\ComNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ComNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComNote[]    findAll()
 * @method ComNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComNote::class);
    }

    // /**
    //  * @return ComNote[] Returns an array of ComNote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ComNote
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
