<?php

namespace App\Repository;

use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    public function findAll(){
        return $this->createQueryBuilder('activity')
            ->orderBy('activity.CreatedAt', 'DESC')
            ->andWhere('activity.IsVisible = :bool')
            ->setParameter(':bool', true)
            ->getQuery()
            ->getResult();
    }

    public function findAllHidden(){
        return $this->createQueryBuilder('activity')
            ->orderBy('activity.CreatedAt', 'DESC')
            ->andWhere('activity.IsVisible = :bool')
            ->setParameter(':bool', false)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Activity[] Return the 3 last activities
     */
    public function findLast(){
        return $this->createQueryBuilder('activity')
            ->orderBy('activity.CreatedAt', 'DESC')
            ->andWhere('activity.IsVisible = :bool')
            ->setParameter(':bool', true)
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * Used to count Activities in database
     */
    public function getTotalActivities(){
        return $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return Activity[] Returns an array of Activity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Activity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
