<?php

namespace App\Repository;

use App\Entity\CalendrierPrestataires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CalendrierPrestataires>
 *
 * @method CalendrierPrestataires|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalendrierPrestataires|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalendrierPrestataires[]    findAll()
 * @method CalendrierPrestataires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendrierPrestatairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalendrierPrestataires::class);
    }

//    /**
//     * @return CalendrierPrestataires[] Returns an array of CalendrierPrestataires objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CalendrierPrestataires
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
