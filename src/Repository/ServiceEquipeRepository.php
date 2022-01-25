<?php

namespace App\Repository;

use App\Entity\ServiceEquipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceEquipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceEquipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceEquipe[]    findAll()
 * @method ServiceEquipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceEquipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceEquipe::class);
    }

    // /**
    //  * @return ServiceEquipe[] Returns an array of ServiceEquipe objects
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
    public function findOneBySomeField($value): ?ServiceEquipe
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
