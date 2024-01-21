<?php

namespace App\Repository;

use App\Entity\PhysicalTraits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PhysicalTraits>
 *
 * @method PhysicalTraits|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhysicalTraits|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhysicalTraits[]    findAll()
 * @method PhysicalTraits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhysicalTraitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhysicalTraits::class);
    }

//    /**
//     * @return PhysicalTraits[] Returns an array of PhysicalTraits objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PhysicalTraits
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
