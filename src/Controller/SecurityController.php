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
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
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
                $token = $tokenGenerator->generateToken();
                $user->setResetToken($token);

                $entityManager->persist($user);
                $entityManager->flush();

                $resetUrl = $this->generateUrl('app_reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
                $emailMessage = (new Email())
                    ->from('noreply@example.com')
                    ->to($user->getEmail())
                    ->subject('Réinitialisation de votre mot de passe')
                    ->html($this->renderView('emails/reset_password.html.twig', [
                        'resetUrl' => $resetUrl
                    ]));

                try {
                    $mailer->send($emailMessage);
                    $this->addFlash('success', 'Un lien de réinitialisation vous a été envoyé par e-mail.');
                } catch (TransportExceptionInterface $e) {
                    $this->addFlash('error', 'Un problème est survenu lors de l\'envoi de l\'e-mail de réinitialisation.');
                }

                return $this->redirectToRoute('app_login');
            } else {
                $this->addFlash('error', 'Aucun utilisateur trouvé avec cette adresse e-mail.');
            }
        }

        return $this->render('security/forgot_password.html.twig');
    }
}
