<?php

namespace App\Repository;

use App\Entity\HorasExtra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HorasExtra|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorasExtra|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorasExtra[]    findAll()
 * @method HorasExtra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorasExtraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorasExtra::class);
    }

    // /**
    //  * @return HorasExtra[] Returns an array of HorasExtra objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HorasExtra
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
