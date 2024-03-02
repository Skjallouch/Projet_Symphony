<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteMaisonController extends AbstractController
{
    #[Route('/recette/maison', name: 'app_recette_maison')]
    public function index(): Response
    {
        return $this->render('features/recette_maison.html.twig', [
            'controller_name' => 'RecetteMaisonController',
        ]);
    }
}
