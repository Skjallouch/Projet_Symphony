<?php

namespace App\Controller;

use App\Entity\PhysicalTraits;
use App\Form\PhysicalTraitsType;
use App\Repository\PhysicalTraitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/physical/traits')]
class PhysicalTraitsController extends AbstractController
{
    #[Route('/', name: 'app_physical_traits_index', methods: ['GET'])]
    public function index(PhysicalTraitsRepository $physicalTraitsRepository): Response
    {
        return $this->render('physical_traits/login.html.twig', [
            'physical_traits' => $physicalTraitsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_physical_traits_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $physicalTrait = new PhysicalTraits();
        $form = $this->createForm(PhysicalTraitsType::class, $physicalTrait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($physicalTrait);
            $entityManager->flush();

            return $this->redirectToRoute('app_physical_traits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('physical_traits/new.html.twig', [
            'physical_trait' => $physicalTrait,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_physical_traits_show', methods: ['GET'])]
    public function show(PhysicalTraits $physicalTrait): Response
    {
        return $this->render('physical_traits/show.html.twig', [
            'physical_trait' => $physicalTrait,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_physical_traits_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PhysicalTraits $physicalTrait, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PhysicalTraitsType::class, $physicalTrait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_physical_traits_index', [], Response::HTTP_SEE_OTHER);
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
