<?php

namespace App\Repository;

use App\Entity\Demande;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Demande>
 *
 * @method Demande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Demande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Demande[]    findAll()
 * @method Demande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Demande::class);
    }
    public function getDemandesByUser(User $user)
    {
        $qb = $this->createQueryBuilder("d")
            ->where('d.user = :user')
            ->setParameter('user', $user);

        return $qb->getQuery()->getResult();
    }
    public function getDemandesByMatiere()
    {
        return $this->createQueryBuilder('d')
            ->select('m.designation AS matiere, COUNT(d.id) AS nombre_demandes, SUM(CASE WHEN d.statut = 1 THEN 1 ELSE 0 END) AS nombre_demandes_validated')
            ->leftJoin('d.id_matiere', 'm')
            ->groupBy('m.designation')
            ->getQuery()
            ->getResult();
    }
    public function getValidatedDemandesByMatiere()
    {
        return $this->createQueryBuilder('d')
            ->select('m.designation AS matiere, COUNT(d.id) AS nombre_demandes_validated')
            ->leftJoin('d.matiere', 'm')
            ->where('d.status = 1') // Suppose que 1 représente le statut des demandes validées
            ->groupBy('m.designation')
            ->getQuery()
            ->getResult();
    }


    public function findDemandeByUserId($userId)
    {
        $qb = $this->createQueryBuilder('d');

        // Construire la requête
        $qb->select('d')
            ->innerJoin('d.user', 'cu')
            ->where('cu.id = :userId')
            ->setParameter('userId', $userId);

        return $qb->getQuery()->getResult();

    }

//    /**
//     * @return Demande[] Returns an array of Demande objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Demande
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
