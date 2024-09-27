<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentaireRepository;
use App\Entity\Commentaire;

class CommentaireController extends AbstractController
{
    #[Route('/commentaire', name: 'app_commentaire')]
    public function index(): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }

    #[Route('/commentaire/create', name: 'commentaire_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setName('commentaire');
    
        // Persister et sauvegarder le commentaire
        $entityManager->persist($commentaire);
        $entityManager->flush();
    
        return new Response('Commentaire créé avec succès !');
    }

    #[Route('/commentaires', name: 'commentaire_index')]
    public function index2(CommentaireRepository $commentaireRepository): Response
    {
        // Vous pouvez injecter EntityManagerInterface à la place de BurgerRepository qui n'existe pas encore 
        $commentaire = $commentaireRepository->findAll();
        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaire,
        ]);
    }
}
