<?php

namespace App\Repository;

use App\Entity\Exercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Exercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercice::class);
    }

    public function findAll(){
        return $this->createQueryBuilder('exercice')
            ->orderBy('exercice.CreatedAt', 'DESC')
            ->andWhere('exercice.IsVisible = :bool')
            ->setParameter(':bool', true)
            ->getQuery()
            ->getResult();
    }

    public function findAllHidden(){
        return $this->createQueryBuilder('exercice')
            ->orderBy('exercice.CreatedAt', 'DESC')
            ->andWhere('exercice.IsVisible = :bool')
            ->setParameter(':bool', false)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Exercice[] Return the 3 last activities
     */
    public function findLast(){
        return $this->createQueryBuilder('exercice')
            ->orderBy('exercice.CreatedAt', 'DESC')
            ->andWhere('exercice.IsVisible = :bool')
            ->setParameter(':bool', true)
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * Used to count Exercices in database
     */
    public function getTotalExercices(){
        return $this->createQueryBuilder('e')
            ->select('count(e.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return Exercice[] Returns an array of Exercice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exercice
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
