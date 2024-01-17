<?php

namespace App\Repository;

use App\Entity\Ressouce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ressouce>
 *
 * @method Ressouce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ressouce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ressouce[]    findAll()
 * @method Ressouce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RessouceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ressouce::class);
    }

//    /**
//     * @return Ressouce[] Returns an array of Ressouce objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ressouce
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
