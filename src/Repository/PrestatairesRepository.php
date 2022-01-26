<?php

namespace App\Repository;

use App\Entity\Prestataires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prestataires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestataires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestataires[]    findAll()
 * @method Prestataires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestatairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestataires::class);
    }

    public function triPosition()
    {
        return $this->createQueryBuilder('d')
            ->orderBy('d.position', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Prestataires[] Returns an array of Prestataires objects
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
    public function findOneBySomeField($value): ?Prestataires
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
