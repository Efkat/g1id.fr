<?php

namespace App\Repository;

use App\Entity\Course;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Course|null find($id, $lockMode = null, $lockVersion = null)
 * @method Course|null findOneBy(array $criteria, array $orderBy = null)
 * @method Course[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Course::class);
    }

    public function findAll(){
        return $this->createQueryBuilder('course')
            ->orderBy('course.CreatedAt', 'DESC')
            ->andWhere('course.IsVisible = :bool')
            ->setParameter(':bool', true)
            ->getQuery()
            ->getResult();
    }

    public function findAllHidden(){
        return $this->createQueryBuilder('course')
            ->orderBy('course.CreatedAt', 'DESC')
            ->andWhere('course.IsVisible = :bool')
            ->setParameter(':bool', false)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Course[] Return the 3 last courses
     */
    public function findLast(){
        return $this->createQueryBuilder('course')
            ->orderBy('course.CreatedAt', 'DESC')
            ->setMaxResults(3)
            ->andWhere('course.IsVisible = :bool')
            ->setParameter(':bool', true)
            ->getQuery()
            ->getResult();
    }

    /**
     * Used to count Courses in database
     */
    public function getTotalCourses(){
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return Course[] Returns an array of Course objects
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
    public function findOneBySomeField($value): ?Course
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
