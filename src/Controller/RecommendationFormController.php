<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecommendationFormController extends AbstractController
{
    #[Route('/recommendations', name: 'app_recommendation_form')]
    public function index(): Response
    {
        return $this->render('features/recommendationForm.html.twig', [
            'controller_name' => 'RecommendationFormController',
        ]);
    }
}
