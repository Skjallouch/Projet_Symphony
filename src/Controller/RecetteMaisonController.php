<?php
/*
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteMaisonController extends AbstractController
{
    #[Route('/recettes', name: 'app_recette_maison')]
    public function index(): Response
    {
        return $this->render('features/recette_maison.html.twig', [
            'controller_name' => 'RecetteMaisonController',
        ]);
    }
}
//avant le test pour carroussel
*/


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;

// Assurez-vous d'inclure le composant Finder

class RecetteMaisonController extends AbstractController
{
    #[Route('/recettes', name: 'app_recette_maison')]
    public function index(): Response
    {
        $projectDir = $this->getParameter('kernel.project_dir');
        $imagesDir = $projectDir . '/public/images/nos_superbes_recettes/recette_caroussel';

        $finder = new Finder();
        $finder->files()->in($imagesDir);

        $images = [];
        foreach ($finder as $file) {
            $images[] = 'images/recette_caroussel/' . $file->getRelativePathname();
        }

        return $this->render('features/recette_maison.html.twig', [
            'controller_name' => 'RecetteMaisonController',
            'photos_caroussel' => $images
        ]);
    }
}




