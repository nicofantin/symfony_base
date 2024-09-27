<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OignonController extends AbstractController
{
    #[Route('/oignon', name: 'app_oignon')]
    public function index(): Response
    {
        return $this->render('oignon/index.html.twig', [
            'controller_name' => 'OignonController',
        ]);
    }

    #[Route('/oignon/create', name: 'oignon_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $oignon = new Oignon();
        $oignon->setName('Oignon rouge');
    
        // Persister et sauvegarder l'oignon
        $entityManager->persist($oignon);
        $entityManager->flush();
    
        return new Response('Oignon créé avec succès !');
    }

    #[Route('/oignons', name: 'oignon_index')]
    public function index2(OignonRepository $oignonRepository): Response
    {
        // Vous pouvez injecter EntityManagerInterface à la place de BurgerRepository qui n'existe pas encore 
        $oignons = $oignonRepository->findAll();
        return $this->render('oignon/index.html.twig', [
            'oignons' => $oignon,
        ]);
    }
}
