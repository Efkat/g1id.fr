<?php

namespace App\Repository;

use App\Entity\Progession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Progession|null find($id, $lockMode = null, $lockVersion = null)
 * @method Progession|null findOneBy(array $criteria, array $orderBy = null)
 * @method Progession[]    findAll()
 * @method Progession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Progession::class);
    }

    // /**
    //  * @return Progession[] Returns an array of Progession objects
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
    public function findOneBySomeField($value): ?Progession
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
