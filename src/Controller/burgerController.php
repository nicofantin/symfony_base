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
    #[Route('/burger/{id}', name: 'burger_id')]
    public function show(int $id): Response
    {
        $tableau = [0,1,2];
        $burger = $tableau[$id];
        return $this->render('burger_show.html.twig', ['tableau' => $burger]);
    }
}