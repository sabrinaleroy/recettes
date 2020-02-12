<?php

namespace App\Repository;

use App\Entity\InstructionItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method InstructionItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method InstructionItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method InstructionItem[]    findAll()
 * @method InstructionItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstructionItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InstructionItem::class);
    }

    // /**
    //  * @return InstructionItem[] Returns an array of InstructionItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InstructionItem
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
