<?php

namespace App\Repository;

use App\Entity\Soutien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Soutien>
 *
 * @method Soutien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Soutien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Soutien[]    findAll()
 * @method Soutien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoutienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soutien::class);
    }

//    /**
//     * @return Soutien[] Returns an array of Soutien objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Soutien
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
