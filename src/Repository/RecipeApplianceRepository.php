<?php

namespace App\Repository;

use App\Entity\RecipeAppliance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RecipeAppliance|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeAppliance|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeAppliance[]    findAll()
 * @method RecipeAppliance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeApplianceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeAppliance::class);
    }

    // /**
    //  * @return RecipeAppliance[] Returns an array of RecipeAppliance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecipeAppliance
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
