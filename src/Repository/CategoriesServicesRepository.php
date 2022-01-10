<?php

namespace App\Repository;

use App\Entity\CategoriesServices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoriesServices|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriesServices|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriesServices[]    findAll()
 * @method CategoriesServices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesServicesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriesServices::class);
    }

    // /**
    //  * @return CategoriesServices[] Returns an array of CategoriesServices objects
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
    public function findOneBySomeField($value): ?CategoriesServices
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
