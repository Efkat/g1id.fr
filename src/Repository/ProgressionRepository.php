<?php

namespace App\Repository;

use App\Entity\Progression;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Progression|null find($id, $lockMode = null, $lockVersion = null)
 * @method Progression|null findOneBy(array $criteria, array $orderBy = null)
 * @method Progression[]    findAll()
 * @method Progression[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgressionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Progression::class);
    }

    /**
     * @return Progression[] Returns an array which contains all exercises mark as read by a $user
     * @param User $user
     */
    public function getAllExercises(User $user): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.type = :type')
            ->andWhere('p.user = :user')
            ->setParameter('user', $user)
            ->setParameter('type', "exercice")
            ->getQuery()
            ->getArrayResult();
    }

    // /**
    //  * @return Progression[] Returns an array of Progression objects
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
    public function findOneBySomeField($value): ?Progression
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
