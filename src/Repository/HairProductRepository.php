<?php

namespace App\Repository;

use App\Entity\HairProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HairProduct>
 *
 * @method HairProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method HairProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method HairProduct[]    findAll()
 * @method HairProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HairProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HairProduct::class);
    }

//    /**
//     * @return HairProduct[] Returns an array of HairProduct objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HairProduct
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
