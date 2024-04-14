<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\PhysicalTraits;
use App\Form\MemberType;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/member')]
class MemberController extends AbstractController
{
    #[Route('/', name: 'app_member_index', methods: ['GET'])]
    public function index(MemberRepository $memberRepository, Security $security): Response
    {

        $user = $security->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/login.html.twig', [
            'members' => $memberRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_member_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $member = new Member();
        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword(
                $member,
                $member->getPassword()
            );
            $member->setPassword($hashedPassword);

            $entityManager->persist($member);
            $entityManager->flush();

            return $this->redirectToRoute('app_member_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('member/new.html.twig', [
            'member' => $member,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_member_show', methods: ['GET'])]
    public function show(Member $member, EntityManagerInterface $entityManager, Security $security): Response
    {

        $user = $security->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $existingPhysicalTrait = $entityManager->getRepository(PhysicalTraits::class)->findOneBy(['member' => $user]);

        return $this->render('member/show.html.twig', [
            'member' => $member,
            'physicalTrait' => $existingPhysicalTrait
        ]);
    }

    #[Route('/{id}/edit', name: 'app_member_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Member $member, EntityManagerInterface $entityManager, Security $security): Response
    {

        $user = $security->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            return $this->redirectToRoute('app_member_show', ['id' => $member->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('member/edit.html.twig', [
            'member' => $member,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_member_delete', methods: ['POST'])]
    public function delete(Request $request, Member $member, EntityManagerInterface $entityManager, Security $security): Response
    {

        $user = $security->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        if ($this->isCsrfTokenValid('delete'.$member->getId(), $request->request->get('_token'))) {
            $entityManager->remove($member);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_member_index', [], Response::HTTP_SEE_OTHER);
    }
}
