<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $projectDir = $this->getParameter('kernel.project_dir'); // Récupère le répertoire racine du projet
        $imagesDir = $projectDir . '/public/images/home_caroussel'; // Chemin vers le dossier des images

        $finder = new Finder();
        $finder->files()->in($imagesDir);

        $images = [];
        foreach ($finder as $file) {
            // Stocke le chemin relatif pour chaque image
            $images[] = 'images/home_caroussel/' . $file->getRelativePathname();
        }

        return $this->render('features/home.html.twig', [
            'controller_name' => 'HomeController',
            'photos_caroussel' => $images
        ]);
    }
}
