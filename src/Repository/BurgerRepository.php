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

    public function findTopXBurgers(int $limit): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT b
            FROM App\Entity\Burger b
            ORDER BY b.price DESC'
        )->setMaxResults($limit);

        return $query->getResult();
    }

    public function findBurgersWithoutIngredient(object $ingredient): array
    {
        $ingredientType = get_class($ingredient); // Récupère le nom complet de la classe
        $entityName = substr($ingredientType, strrpos($ingredientType, '\\') + 1); // Extrait le nom simple de l'entité

        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            "SELECT b
            FROM App\Entity\Burger b
            LEFT JOIN b.$entityName i
            WHERE i.id IS NULL OR i.id != :ingredientId"
        )->setParameter('ingredientId', $ingredient->getId());

        return $query->getResult();
    }

    public function findBurgersWithMinimumIngredients(int $minIngredients): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT b, COUNT(i.id) as HIDDEN ingredient_count
            FROM App\Entity\Burger b
            JOIN b.Oignon i
            GROUP BY b.id
            HAVING ingredient_count >= :minIngredients'
        )->setParameter('minIngredients', $minIngredients);

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
