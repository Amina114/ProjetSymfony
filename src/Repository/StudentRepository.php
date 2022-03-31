<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    public function getStudentsOrderByEmail(){
        return $this->createQueryBuilder('s')->orderBy('s.email', 'DESC')->getQuery()->getResult();
    }

    public function getStudentsByEmailSpecific(){
        return $this->createQueryBuilder('s1')->andwhere('s1.email LIKE :amina')->setParameter('amina', '%chab%')->getQuery()->getResult() ; 
    }
    public function getStudentsEnabled(){
        return $this->createQueryBuilder('s1')->andwhere('s1.enabled LIKE :amina')->setParameter('amina', '1')->getQuery()->getResult() ;
    }
    public function search($email_var){
        return $this->createQueryBuilder('s1')->andwhere('s1.email LIKE :amina')->setParameter('amina', '%'.$email_var.'%')->getQuery()->getResult() ; 
    }
/*
    public function getStudentsBuClass($class){
        return $this->createQueryBuilder('s')
    }
*/
    // /**
    //  * @return Student[] Returns an array of Student objects
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
    public function findOneBySomeField($value): ?Student
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
