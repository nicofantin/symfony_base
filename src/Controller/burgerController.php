<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class burgerController extends AbstractController
{
    #[Route('/burger', name: 'burger')]
    public function list(): Response
    {
        $tableau = [0,1,2];
        return $this->render('burger.html.twig', ['tableau_burger' => $tableau]);
    }
    
    #[Route('/burger/{id}', name: 'burger_id', requirements: ['id' => '\d+'])]
    public function redirectNumber(int $id): Response
    {
        return $this->render('burger_show.html.twig', ['id' => $id]);
    }
}