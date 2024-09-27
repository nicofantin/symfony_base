<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ImageController extends AbstractController
{
    #[Route('/image', name: 'app_image')]
    public function index(): Response
    {
        return $this->render('image/index.html.twig', [
            'controller_name' => 'ImageController',
        ]);
    }

    #[Route('/image/create', name: 'image_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $image = new Image();
        $image->setName('image');
    
        // Persister et sauvegarder l'image
        $entityManager->persist($image);
        $entityManager->flush();
    
        return new Response('Image créé avec succès !');
    }

    #[Route('/images', name: 'image_index')]
    public function index2(ImageRepository $imageRepository): Response
    {
        // Vous pouvez injecter EntityManagerInterface à la place de BurgerRepository qui n'existe pas encore 
        $images = $imageRepository->findAll();
        return $this->render('image/index.html.twig', [
            'images' => $image,
        ]);
    }
}
