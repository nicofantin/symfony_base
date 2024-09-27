<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SauceRepository;
use App\Entity\Sauce;

class SauceController extends AbstractController
{
    #[Route('/sauce', name: 'app_sauce')]
    public function index(): Response
    {
        return $this->render('sauce/index.html.twig', [
            'controller_name' => 'SauceController',
        ]);
    }

    #[Route('/sauce/create', name: 'sauce_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $sauce = new Sauce();
        $sauce->setName('sauce rouge');
    
        // Persister et sauvegarder la sauce
        $entityManager->persist($sauce);
        $entityManager->flush();
    
        return new Response('Sauce créé avec succès !');
    }

    #[Route('/sauces', name: 'sauce_index')]
    public function index2(SauceRepository $sauceRepository): Response
    {
        // Vous pouvez injecter EntityManagerInterface à la place de BurgerRepository qui n'existe pas encore 
        $sauce = $sauceRepository->findAll();
        return $this->render('sauce/index.html.twig', [
            'sauce' => $sauce,
        ]);
    }
}
