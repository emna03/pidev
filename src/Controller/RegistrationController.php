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
use App\Security\LoginFormAuthenticator;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        UserAuthenticatorInterface $userAuthenticator,
        LoginFormAuthenticator $authenticator
    ): Response {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();

            $user->setMotDePasse(
                $userPasswordHasher->hashPassword($user, $plainPassword)
            );

            $user->setDateInscription(new \DateTime());
            $user->setActiver(1);
            $user->setVisage_hash(null);

            $entityManager->persist($user);
            $entityManager->flush();

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
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

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/complete_profil.html.twig');
    }
}
