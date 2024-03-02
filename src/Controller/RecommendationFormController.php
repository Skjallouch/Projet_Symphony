<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecommendationFormController extends AbstractController
{
    #[Route('/recommendation/form', name: 'app_recommendation_form')]
    public function index(): Response
    {
        return $this->render('recommendation_form/index.html.twig', [
            'controller_name' => 'RecommendationFormController',
        ]);
    }
}
