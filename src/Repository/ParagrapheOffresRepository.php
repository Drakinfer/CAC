<?php

namespace App\Repository;

use App\Entity\ParagrapheOffres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParagrapheOffres|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParagrapheOffres|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParagrapheOffres[]    findAll()
 * @method ParagrapheOffres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParagrapheOffresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParagrapheOffres::class);
    }

    // /**
    //  * @return ParagrapheOffres[] Returns an array of ParagrapheOffres objects
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
    public function findOneBySomeField($value): ?ParagrapheOffres
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
