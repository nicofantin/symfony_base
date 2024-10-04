<?php

namespace App\Repository;

use App\Entity\Burger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Burger>
 */
class BurgerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Burger::class);
    }

    public function findSpecificBurgers(string $ingredient): array
    {
        $entityManager = $this->getEntityManager();
    
        // Assurez-vous que la syntaxe DQL correspond à votre modèle de données.
        $query = $entityManager->createQuery(
            'SELECT b
            FROM App\Entity\Burger b
            JOIN b.Oignon o
            WHERE o.name = :ingredient'
        )->setParameter('ingredient', $ingredient);
    
        return $query->getResult();
    }
    


//    /**
//     * @return Burger[] Returns an array of Burger objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Burger
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
