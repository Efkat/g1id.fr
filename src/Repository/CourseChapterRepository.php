<?php

namespace App\Repository;

use App\Entity\CourseChapter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CourseChapter|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourseChapter|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourseChapter[]    findAll()
 * @method CourseChapter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseChapterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourseChapter::class);
    }

    // /**
    //  * @return CourseChapter[] Returns an array of CourseChapter objects
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
    public function findOneBySomeField($value): ?CourseChapter
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
