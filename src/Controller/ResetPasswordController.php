<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use App\Security\LoginFormAuthenticator;

class ResetPasswordController extends AbstractController
{
    #[Route('/forgot-password', name: 'app_forgot_password')]
    public function forgotPassword(
        Request $request,
        UtilisateurRepository $utilisateurRepository,
        EntityManagerInterface $em,
        MailerInterface $mailer,
        UrlGeneratorInterface $urlGenerator
    ): Response {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $user = $utilisateurRepository->findOneBy(['email' => $email]);

            if (!$user) {
                $this->addFlash('error', 'Aucun compte trouvé avec cet email.');
                return $this->redirectToRoute('app_forgot_password');
            }

            // 🔐 Code à 4 chiffres stocké en session
            $resetCode = random_int(1000, 9999);
            $session = $request->getSession();
            $session->set('reset_user_id', $user->getId());
            $session->set('reset_code', $resetCode);

            // Envoi de l’e-mail
            $link = $urlGenerator->generate('app_verify_reset_code', [], UrlGeneratorInterface::ABSOLUTE_URL);

            $logoPath = $this->getParameter('kernel.project_dir') . '/public/logo_civismart.png';

            $emailObj = (new Email())
                ->from('chemlaliismail388@gmail.com')
                ->to($user->getEmail())
                ->subject('Réinitialisation de mot de passe');

                $logoCid = $emailObj->embedFromPath($logoPath, 'logo_civismart');

    // 💌 Contenu HTML stylisé
    $html = "
        <div style='font-family: Arial, sans-serif; color: #333; background-color: #f9f9f9; padding: 20px;'>
            <div style='max-width: 600px; margin: auto; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>
                <div style='background-color: #620eb0; padding: 20px; text-align: center;'>
                    <img src='cid:logo_civismart' alt='CiviSmart' style='height: 80px; margin-bottom: 10px;' />
                    <h1 style='color: white; font-size: 24px;'>Bienvenue sur CiviSmart</h1>
                </div>
                <div style='padding: 30px;'>
                    <p>Bonjour <strong>{$user->getPrenom()}</strong>,</p>
                    <p>Voici votre <strong>code de réinitialisation</strong> :</p>
<h2 style='text-align:center; font-size:28px; letter-spacing:5px; color:#620eb0;'>{$resetCode}</h2>
<p>Ou cliquez sur le bouton ci-dessous pour le saisir :</p>
                    <p>Merci pour votre inscription sur <strong>CiviSmart</strong> ! 🎉</p>
                    <p>Pour finaliser votre inscription, veuillez cliquer sur le bouton ci-dessous pour activer votre compte :</p>
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='{$link}' style='background-color: #620eb0; color: white; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold; display: inline-block;'>
                            Activer mon compte
                        </a>
                    </div>
                    <p>Si vous n'êtes pas à l'origine de cette inscription, vous pouvez ignorer cet email.</p>
                    <p>À bientôt,<br>L'équipe CiviSmart 🚀</p>
                </div>
                <div style='background-color: #f1f1f1; padding: 15px; text-align: center; font-size: 12px; color: #888;'>
                    &copy; " . date('Y') . " CiviSmart. Tous droits réservés.
                </div>
            </div>
        </div>
    ";

                
                $emailObj = (new Email())
                    ->from('chemlaliismail388@gmail.com')
                    ->to($user->getEmail())
                    ->subject('🔐 Réinitialisation de mot de passe CiviSmart')
                    ->html($html);
                
                $mailer->send($emailObj);
            $this->addFlash('mail_popup', true);
            return $this->render('reset_password/forgot.html.twig', [
                'show_modal' => true
            ]);
        }

        return $this->render('reset_password/forgot.html.twig');
    }

    #[Route('/verify-reset-code', name: 'app_verify_reset_code')]
    public function verifyCode(Request $request, UtilisateurRepository $repo): Response
    {
        $session = $request->getSession();
        $userId = $session->get('reset_user_id');
        $storedCode = $session->get('reset_code');

        if (!$userId || !$storedCode) {
            return $this->redirectToRoute('app_forgot_password');
        }

        $user = $repo->find($userId);
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé.');
        }

        if ($request->isMethod('POST')) {
            $code = trim($request->request->get('code'));

            if ($code === (string)$storedCode) {
                $session->set('verified_reset', true);
                $this->addFlash('success', '✅ Code vérifié.');
                return $this->redirectToRoute('app_reset_password_new');
            } else {
                $this->addFlash('error', '❌ Code incorrect.');
            }
        }

        return $this->render('reset_password/verify_code.html.twig', ['user' => $user]);
    }

    #[Route('/reset-password/new', name: 'app_reset_password_new')]
    public function resetPasswordNew(
        Request $request,
        UtilisateurRepository $repo,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher,
        UserAuthenticatorInterface $authenticator,
        LoginFormAuthenticator $loginAuthenticator
    ): Response {
        $session = $request->getSession();
        $userId = $session->get('reset_user_id');
        $verified = $session->get('verified_reset', false);

        if (!$userId || !$verified) {
            return $this->redirectToRoute('app_forgot_password');
        }

        $user = $repo->find($userId);
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé.');
        }

        if ($request->isMethod('POST')) {
            $newPassword = $request->request->get('new_password');
            $confirmPassword = $request->request->get('confirm_password');

            if ($newPassword !== $confirmPassword) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                return $this->redirectToRoute('app_reset_password_new');
            }

            $user->setMotDePasse($hasher->hashPassword($user, $newPassword));
            $em->flush();

            // 🔒 Nettoyage session
            $session->remove('reset_user_id');
            $session->remove('reset_code');
            $session->remove('verified_reset');

            $this->addFlash('success', 'Votre mot de passe a été mis à jour avec succès ✅');

            // Connexion automatique
            return $authenticator->authenticateUser($user, $loginAuthenticator, $request);
        }

        return $this->render('reset_password/reset_form.html.twig', ['user' => $user]);
    }
}
