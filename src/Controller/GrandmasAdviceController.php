<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GrandmasAdviceController extends AbstractController
{
    #[Route('/advice', name: 'app_grandmas_advice')]
    public function index(): Response
    {
        return $this->render('features/grandmasAdvice.html.twig', [
            'controller_name' => 'GrandmasAdviceController',
        ]);
    }
}
