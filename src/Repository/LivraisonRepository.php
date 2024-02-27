<?php

namespace App\Repository;

use App\Entity\Livraison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livraison>
 *
 * @method Livraison|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livraison|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livraison[]    findAll()
 * @method Livraison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivraisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livraison::class);
    }

    // Example search method in TransportRepository
    public function search($query)
    {
        return $this->createQueryBuilder('l')
                        ->leftJoin('l.matricule', 't')  // Assuming 'matricule' is the property name of the relationship with the Transport entity
                        ->leftJoin('l.Nom', 'livreur')  // Assuming 'Nom' is the property name of the relationship with the Livreur entity
                        ->andWhere('l.dateLiv LIKE :query')
                        ->orWhere('t.matricule LIKE :query')  // Reference the 'matricule' attribute of the Transport entity
                        ->orWhere('livreur.Nom LIKE :query')  // Reference the 'Nom' attribute of the Livreur entity
                        ->setParameter('query', '%' . $query . '%')
                        ->getQuery()
                        ->getResult();
                }
//    /**
//     * @return Livraison[] Returns an array of Livraison objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Livraison
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
