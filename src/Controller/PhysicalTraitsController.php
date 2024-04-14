<?php

namespace App\Controller;

use App\Entity\Hair;
use App\Entity\PhysicalTraits;
use App\Form\PhysicalTraitsType;
use App\Repository\PhysicalTraitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/physical/traits')]
class PhysicalTraitsController extends AbstractController
{
    #[Route('/', name: 'app_physical_traits_index', methods: ['GET'])]
    public function index(PhysicalTraitsRepository $physicalTraitsRepository, Security $security): Response
    {
        $user = $security->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('physical_traits/index.html.twig', [
            'physical_traits' => $physicalTraitsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_physical_traits_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Security $security, EntityManagerInterface $entityManager): Response
    {
        $physicalTraits = new PhysicalTraits();
        $hair = new Hair();
        // Récupérer l'utilisateur connecté
        $user = $security->getUser();

        $physicalTraits->setHair($hair); // Lie le Hair à PhysicalTraits

        if ($user) {
            $physicalTraits->setMember($user); // Lie le Member connecté à PhysicalTraits
        } else {
            // Gérer l'absence de l'utilisateur connecté si nécessaire
            return $this->redirectToRoute('app_member_index'); // ou toute autre gestion d'erreur
        }

        // Vérifier si l'utilisateur a déjà un PhysicalTraits
        $existingPhysicalTraits = $entityManager->getRepository(PhysicalTraits::class)->findOneBy(['member' => $user]);

        if ($existingPhysicalTraits !== null) {
            // Rediriger vers une route si l'utilisateur a déjà un PhysicalTraits
            return $this->redirectToRoute('app_physical_traits_show', ['id' => $existingPhysicalTraits->getId()]);
        }

        $form = $this->createForm(PhysicalTraitsType::class, $physicalTraits);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hair); // Persiste d'abord l'objet Hair
            $entityManager->persist($physicalTraits);
            $entityManager->flush();

            return $this->redirectToRoute('app_physical_traits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('physical_traits/new.html.twig', [
            'physical_trait' => $physicalTraits,
            'form' => $form,
        ]);
    }

    private function getHaircutRecommendation(PhysicalTraits $physicalTrait): string
    {
        $faceShape = $physicalTrait->getFaceShape();
        $eyeColor = $physicalTrait->getEyeColor();  // Ajouté si nécessaire pour des conditions futures
        $skinColor = $physicalTrait->getSkinColor();  // Ajouté si nécessaire pour des conditions futures
        $hair = $physicalTrait->getHair();

        if (!$hair) {
            return 'Information insuffisante pour recommander une coupe de cheveux'; // Gérer le cas où Hair n'est pas défini
        }

        $hairLength = $hair->getHairLength();
        $hairType = $hair->getHairType();
        $hairColor = $hair->getHairColor();
        $cutCut = $hair->getCutcut();
        $coloration = $hair->getColoration();

        // Conditions pour la Coupe Chelsea
        if ($faceShape === 'ovale' && $hairLength === 'mi-longue') {
            return 'Coupe Chelsea';
        }

        // Conditions pour la Coupe Bob Moderne
        if ($faceShape === 'carré' && in_array($cutCut, ['carré', 'carré bob']) && $hairLength === 'coupe au carré') {
            return 'Coupe Bob Moderne';
        }

        // Conditions pour Long Layers Glamour
        if ($faceShape === 'coeur' && $hairLength === 'longue' && in_array($cutCut, ['ondulée', 'coupe en dégradé'])) {
            return 'Long Layers Glamour';
        }

        // Conditions pour Pixie Texturé
        if ($faceShape === 'rond' && $hairLength === 'courte' && in_array($cutCut, ['coupe courte', 'coupe au rasoir'])) {
            return 'Pixie Texturé';
        }

        // Coupe par défaut
        return 'Le Lob Polyvalent';
    }

    #[Route('/{id}', name: 'app_physical_traits_show', methods: ['GET'])]
    public function show(PhysicalTraits $physicalTrait, Security $security): Response
    {

        $user = $security->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        if ($user !== $physicalTrait->getMember()) {
            // Si l'utilisateur connecté n'est pas le propriétaire des PhysicalTraits, ou pour vérifier si l'utilisateur a des PhysicalTraits
            return $this->redirectToRoute('app_physical_traits_new');
        }

        $haircutRecommendation = $this->getHaircutRecommendation($physicalTrait);

        return $this->render('physical_traits/show.html.twig', [
            'physical_trait' => $physicalTrait,
            'haircut' => $haircutRecommendation
        ]);
    }

    #[Route('/{id}/edit', name: 'app_physical_traits_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PhysicalTraits $physicalTrait, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PhysicalTraitsType::class, $physicalTrait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_physical_traits_show', ['id' => $physicalTrait->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('physical_traits/edit.html.twig', [
            'physical_trait' => $physicalTrait,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_physical_traits_delete', methods: ['POST'])]
    public function delete(Request $request, PhysicalTraits $physicalTrait, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$physicalTrait->getId(), $request->request->get('_token'))) {
            $entityManager->remove($physicalTrait);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_physical_traits_index', [], Response::HTTP_SEE_OTHER);
    }
}
