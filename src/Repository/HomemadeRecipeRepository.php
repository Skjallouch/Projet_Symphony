<?php

namespace App\Repository;

use App\Entity\HomemadeRecipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HomemadeRecipe>
 *
 * @method HomemadeRecipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomemadeRecipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomemadeRecipe[]    findAll()
 * @method HomemadeRecipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomemadeRecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomemadeRecipe::class);
    }

//    /**
//     * @return HomemadeRecipe[] Returns an array of HomemadeRecipe objects
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

//    public function findOneBySomeField($value): ?HomemadeRecipe
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
