<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\BurgerRepository;
use App\Entity\Burger;

class BurgerController extends AbstractController
{

    #[Route('/burger1', name: 'burger1')]
    public function list(): Response
    {
        $tableau = [0,1,2];
        return $this->render('burger.html.twig', ['tableau_burger' => $tableau]);
    }
    
    #[Route('/burger1/{id}', name: 'burger1_id', requirements: ['id' => '\d+'])]
    public function redirectNumber(int $id): Response
    {
        return $this->render('burger_show.html.twig', ['id' => $id]);
    }

    #[Route('/burger', name: 'app_burger')]
    public function index(): Response
    {
        return $this->render('burger/index.html.twig', [
            'controller_name' => 'BurgerController',
        ]);
    }

    #[Route('/burger/create', name: 'burger_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $burger = new Burger();
        $burger->setName('burger');
    
        // Persister et sauvegarder le burger
        $entityManager->persist($burger);
        $entityManager->flush();
    
        return new Response('Burger créé avec succès !');
    }

    #[Route('/burgers', name: 'burger_index')]
    public function index2(BurgerRepository $burgerRepository): Response
    {
        // Vous pouvez injecter EntityManagerInterface à la place de BurgerRepository qui n'existe pas encore 
        $burgers = $burgerRepository->findAll();
        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
        ]);
    }
}
