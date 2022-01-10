<?php

namespace App\Repository;

use App\Entity\LigneProgramme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LigneProgramme|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneProgramme|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneProgramme[]    findAll()
 * @method LigneProgramme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneProgrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneProgramme::class);
    }

    // /**
    //  * @return LigneProgramme[] Returns an array of LigneProgramme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LigneProgramme
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
