<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PainRepository;
use App\Entity\Pain;

class PainController extends AbstractController
{
    #[Route('/pain', name: 'app_pain')]
    public function index(): Response
    {
        return $this->render('pain/index.html.twig', [
            'controller_name' => 'PainController',
        ]);
    }

    #[Route('/pain/create', name: 'pain_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $pain = new Pain();
        $pain->setName('Pain rouge');
    
        // Persister et sauvegarder le pain
        $entityManager->persist($pain);
        $entityManager->flush();
    
        return new Response('Pain créé avec succès !');
    }

    #[Route('/pains', name: 'pain_index')]
    public function index2(PainRepository $painRepository): Response
    {
        // Vous pouvez injecter EntityManagerInterface à la place de BurgerRepository qui n'existe pas encore 
        $pain = $painRepository->findAll();
        return $this->render('pain/index.html.twig', [
            'pains' => $pain,
        ]);
    }
}
