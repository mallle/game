<?php

namespace App\Repository;

use App\Entity\Attitude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Attitude|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attitude|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attitude[]    findAll()
 * @method Attitude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttitudeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attitude::class);
    }

    // /**
    //  * @return Attitude[] Returns an array of Attitude objects
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
    public function findOneBySomeField($value): ?Attitude
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
