<?php

namespace App\Repository;

use App\Entity\ValorHoras;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ValorHoras|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValorHoras|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValorHoras[]    findAll()
 * @method ValorHoras[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValorHorasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValorHoras::class);
    }

    // /**
    //  * @return ValorHoras[] Returns an array of ValorHoras objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ValorHoras
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
