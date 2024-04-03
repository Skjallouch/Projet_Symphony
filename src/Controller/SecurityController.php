<?php

namespace App\Controller;

use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastEmail = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_email' => $lastEmail,
            'error' => $error
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    #[Route('/forgot-password', name: 'app_forgot_password')]
    public function forgotPassword(Request $request, MemberRepository $userRepository, EntityManagerInterface $entityManager, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator, UrlGeneratorInterface $urlGenerator): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $user = $userRepository->findOneByEmail($email);

            if ($user) {
                do {
                    $token = bin2hex(random_bytes(16)); // Génère un nouveau token
                    $existingUser = $userRepository->findOneByResetToken($token); // Vérifie si le token est déjà utilisé
                } while ($existingUser !== null); // Répète la génération si le token existe déjà

                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();

                $resetUrl = $this->generateUrl('app_reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
                $emailMessage = (new Email())
                    ->from('noreply@example.com') // Remplacez par votre adresse e-mail d'envoi
                    ->to($user->getEmail())
                    ->subject('Réinitialisation de votre mot de passe')
                    ->html("<p>Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant : <a href='$resetUrl'>Réinitialiser mon mot de passe</a>.</p>");

                try {
                    $mailer->send($emailMessage);
                    $this->addFlash('success', 'Un lien de réinitialisation vous a été envoyé par e-mail.');
                } catch (TransportExceptionInterface $e) {
                    $this->addFlash('error', 'Un problème est survenu lors de l\'envoi de l\'e-mail de réinitialisation.');
                }

                try {
                    $token = bin2hex(random_bytes(16));
                } catch (\Exception $e) {
                    // Log l'erreur, informe l'utilisateur d'un problème technique, etc.
                    $this->addFlash('error', 'Un problème technique est survenu. Veuillez réessayer plus tard.');
                    return $this->redirectToRoute('app_forgot_password'); // Redirigez vers une route appropriée
                }

                try {
                    $user = $userRepository->findOneByEmail($email);
                } catch (\Doctrine\ORM\NonUniqueResultException $e) {
                    // Log l'erreur, informe l'utilisateur d'un problème technique, etc.
                    $this->addFlash('error', 'Plusieurs utilisateurs ont été trouvés avec le même e-mail. Veuillez contacter l\'assistance.');
                   return $this->redirectToRoute('app_forgot_password'); // Redirigez vers une route appropriée
                }


                return $this->redirectToRoute('app_login');
            } else {
                $this->addFlash('error', 'Aucun utilisateur trouvé avec cette adresse e-mail.');
            }
        }

        return $this->render('security/forgot_password.html.twig');
    }


    #[Route('/reset-password/{token}', name: 'app_reset_password')]
    public function resetPassword(Request $request, EntityManagerInterface $entityManager, MemberRepository $userRepository, string $token): Response
    {
        $user = $userRepository->findOneByResetToken($token);
        if (!$user) {
            $this->addFlash('error', 'Token invalide.');
            return $this->redirectToRoute('app_login');
        }

        if ($request->isMethod('POST')) {
            $user->setPassword(/* Nouveau mot de passe hashé */);
            $user->setResetToken(null); // Efface le token de réinitialisation
            $entityManager->flush();

            $this->addFlash('success', 'Mot de passe réinitialisé avec succès.');
            return $this->redirectToRoute('app_login');
        }

        // Affiche le formulaire de réinitialisation du mot de passe
        return $this->render('security/reset_password.html.twig', [
            'token' => $token
        ]);
    }

}
