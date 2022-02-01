<?php

namespace App\Repository;

use App\Entity\ServicePartenaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServicePartenaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServicePartenaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServicePartenaire[]    findAll()
 * @method ServicePartenaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicePartenaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServicePartenaire::class);
    }

    // /**
    //  * @return ServicePartenaire[] Returns an array of ServicePartenaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServicePartenaire
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
