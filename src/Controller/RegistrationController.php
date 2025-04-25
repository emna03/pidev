<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Mime\Email;
use App\Repository\UtilisateurRepository;
use App\Security\LoginFormAuthenticator;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RegistrationController extends AbstractController
{
    private UrlGeneratorInterface $urlGenerator;
    private HttpClientInterface $httpClient;

    public function __construct(UrlGeneratorInterface $urlGenerator, HttpClientInterface $httpClient)
    {
        $this->urlGenerator = $urlGenerator;
        $this->httpClient = $httpClient;
    }

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer,
        UrlGeneratorInterface $urlGenerator,
        UserAuthenticatorInterface $userAuthenticator,
        LoginFormAuthenticator $loginFormAuthenticator
    ): Response {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // reCAPTCHA V3 validation
            $recaptchaToken = $request->request->get('recaptcha_token');

            $response = $this->httpClient->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                'body' => [
                    'secret' => '6LcLCxsrAAAAAN8DuYYQasBK7CMuJUHpAePqbB0u',
                    'response' => $recaptchaToken,
                ],
            ]);

            $recaptchaResult = $response->toArray();

            if (!$recaptchaResult['success'] || $recaptchaResult['score'] < 0.5) {
                $this->addFlash('error', 'Le système a détecté une activité suspecte. Veuillez réessayer.');
                return $this->redirectToRoute('app_register');
            }

            // Hash du mot de passe
            $plainPassword = $form->get('plainPassword')->getData();
            $user->setMotDePasse(
                $userPasswordHasher->hashPassword($user, $plainPassword)
            );

            // Données supplémentaires
            $user->setDateInscription(new \DateTime());
            $user->setActiver(1);
            $user->setVisage_hash(null);

            $entityManager->persist($user);
            $entityManager->flush();

            $activationLink = $urlGenerator->generate('app_activate_account', [
                'id' => $user->getId()
            ], UrlGeneratorInterface::ABSOLUTE_URL);

            $email = (new Email())
            ->from('chemlaliismail388@gmail.com')
            ->to($user->getEmail())
            ->subject('🔐 Activez votre compte CiviSmart')
            ->embedFromPath('public/logo_civismart.png', 'logo_civismart')
            ->html("
            <div style='font-family: Arial, sans-serif; color: #333; background-color: #f9f9f9; padding: 20px;'>
                <div style='max-width: 600px; margin: auto; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>
                    <div style='background-color: #620eb0; padding: 20px; text-align: center;'>
                        <img src='cid:logo_civismart' alt='CiviSmart' style='height: 80px; margin-bottom: 10px;' />
                        <h1 style='color: white; font-size: 24px;'>Bienvenue sur CiviSmart</h1>
                    </div>
                    <div style='padding: 30px;'>
                        <p>Bonjour <strong>{$user->getPrenom()}</strong>,</p>
                        <p>Merci pour votre inscription sur <strong>CiviSmart</strong> ! 🎉</p>
                        <p>Pour finaliser votre inscription, veuillez cliquer sur le bouton ci-dessous pour activer votre compte :</p>
                        <div style='text-align: center; margin: 30px 0;'>
                            <a href='{$activationLink}' style='background-color: #620eb0; color: white; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold; display: inline-block;'>
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
        ");
        
        $mailer->send($email);

            $this->addFlash('success', 'Un email d’activation vous a été envoyé. Veuillez vérifier votre boîte mail.');
            return $userAuthenticator->authenticateUser(
                $user,
                $loginFormAuthenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/profile/complete', name: 'app_profile_complete')]
    public function completeProfile(
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        $user->deactivate();

        if ($request->isMethod('POST')) {
            $numeroTel = $request->request->get('numero_telephone');
            $photoFile = $request->files->get('photo_profil');
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $role = 'Citoyen';

            if ($numeroTel) {
                $user->setNumeroTelephone($numeroTel);
            }

            if ($nom) {
                $user->setNom($nom);
            }

            if ($prenom) {
                $user->setPrenom($prenom);
            }

            if ($role) {
                $user->setRole($role);
            }

            if ($photoFile && $photoFile->isValid()) {
                $filename = $slugger->slug(pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME));
                $newFilename = $filename . '-' . uniqid() . '.' . $photoFile->guessExtension();

                try {
                    $photoFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    $user->setPhotoProfil($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l’enregistrement de la photo de profil.');
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/complete_profil.html.twig');
    }

    #[Route('/activate/{id}', name: 'app_activate_account')]
    public function activateAccount(
        int $id,
        UtilisateurRepository $repo,
        EntityManagerInterface $em
    ): Response {
        $user = $repo->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur introuvable.');
        }

        if ($user->isActivated()) {
            $this->addFlash('info', 'Ce compte est déjà activé.');
        } else {
            $user->activate();
            $em->flush();
            $this->addFlash('success', 'Votre compte a été activé avec succès ✅');
        }

        return $this->redirectToRoute('app_login');
    }

    #[Route('/test-mail', name: 'app_test_mail')]
    public function sendTestMail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('chemlaliismail388@gmail.com')
            ->to('chemlaliismail388@gmail.com')
            ->subject('🎯 Test Mail CiviSmart')
            ->text('Ceci est un test d’envoi d’email.')
            ->html('<p><strong>Test d’email</strong> envoyé depuis Symfony !</p>');

        $mailer->send($email);

        return new Response('✅ Email de test envoyé (vérifie ta boîte !)');
    }
}
