<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function findAll(){
        return $this->createQueryBuilder('project')
            ->orderBy('project.CreatedAt', 'DESC')
            ->andWhere('project.IsVisible = :bool')
            ->setParameter(':bool', true)
            ->getQuery()
            ->getResult();
    }

    public function findAllHidden(){
        return $this->createQueryBuilder('project')
            ->orderBy('project.CreatedAt', 'DESC')
            ->andWhere('project.IsVisible = :bool')
            ->setParameter(':bool', false)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Project[] Return the 3 last projects
     */
    public function findLast(){
        return $this->createQueryBuilder('project')
            ->orderBy('project.CreatedAt', 'DESC')
            ->setMaxResults(3)
            ->andWhere('project.IsVisible = :bool')
            ->setParameter(':bool', true)
            ->getQuery()
            ->getResult();
    }

    /**
     * Used to count Projetcs in database
     */
    public function getTotalProjects(){
        return $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return Project[] Returns an array of Project objects
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
    public function findOneBySomeField($value): ?Project
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
