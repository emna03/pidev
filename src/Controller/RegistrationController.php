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

class RegistrationController extends AbstractController
{
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
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
            // Hash du mot de passe
            $plainPassword = $form->get('plainPassword')->getData();
            $user->setMotDePasse(
                $userPasswordHasher->hashPassword($user, $plainPassword)
            );
    
            // Données supplémentaires
            $user->setDateInscription(new \DateTime());
            $user->setActiver(1); // 
            $user->setVisage_hash(null);
    
            $entityManager->persist($user);
            $entityManager->flush();
    
            // Création du lien d’activation
            $activationLink = $urlGenerator->generate('app_activate_account', [
                'id' => $user->getId()
            ], UrlGeneratorInterface::ABSOLUTE_URL);
    
            // Envoi de l'email
            $email = (new Email())
                ->from('chemlaliismail388@gmail.com')
                ->to('chemlaliismail388@gmail.com')
                ->subject('Activation de votre compte CiviSmart')
                ->html("
                    <p>Bonjour <strong>{$user->getPrenom()}</strong>,</p>
                    <p>Merci pour votre inscription sur CiviSmart.</p>
                    <p>Veuillez cliquer sur le lien ci-dessous pour activer votre compte :</p>
                    <p><a href='{$activationLink}'>Activer mon compte</a></p>
                    <p>Si vous n'êtes pas à l'origine de cette inscription, ignorez ce message.</p>
                ");
    
            $mailer->send($email);
    
            // Message flash + redirection
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
            $role = $request->request->get('role');

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

            return $this->redirectToRoute('home');
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
        ->to('smail.chemlali@esprit.tn')
        ->subject('🎯 Test Mail CiviSmart')
        ->text('Ceci est un test d’envoi d’email.')
        ->html('<p><strong>Test d’email</strong> envoyé depuis Symfony !</p>');

    $mailer->send($email);

    return new Response('✅ Email de test envoyé (vérifie ta boîte !)');
}

}
