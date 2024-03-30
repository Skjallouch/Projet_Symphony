<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentPresentationController extends AbstractController
{
    #[Route('/studentPresentation', name: 'app_student_presentation')]
    public function index(): Response
    {
        return $this->render('student_presentation/studentPresentation.html.twig', [
            'controller_name' => 'StudentPresentationController',
        ]);
    }
}
