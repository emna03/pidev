<?php

namespace App\Controller;

use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Utilisateur;



class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/edit', name: 'app_profile_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();
    
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
    
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {

            $action = $request->request->get('action');

            if ($action === 'disable') {
                // Désactiver le compte
                $user->deactivate(); // Supposons que vous avez un champ "active" dans l'entité User
                $this->addFlash('success', 'Votre compte a été désactivé.');
                // EntityManagerInterface is already injected into the method
                // Use the provided $entityManager directly
                $entityManager->persist($user);
                $entityManager->flush();
    
                return $this->redirectToRoute('app_logout'); // Déconnectez l'utilisateur après désactivation
            }

            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photo_profil')->getData();
    
            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();
    
                try {
                    $photoFile->move(
                        
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    $user->setPhotoProfil($newFilename); // Met à jour le champ dans l'entité
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Erreur lors de l’enregistrement du fichier.');
                }
            }
    
            $entityManager->flush();
    
            $this->addFlash('success', 'Profil mis à jour avec succès.');
            return $this->redirectToRoute('app_profile_edit');
        }
    
        return $this->render('utilisateur/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/profile/deactivate', name: 'app_deactivate_account', methods: ['POST'])]
    public function deactivate(Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('deactivate_account', $request->request->get('_token'))) {
            $this->addFlash('error', 'Token CSRF invalide.');
            return $this->redirectToRoute('app_profile_edit');
        }
    
        $user = $this->getUser();
        if ($user) {
            $user->deactivate(); // ta méthode existante
            $em->flush();
            $this->addFlash('success', 'Ton compte a été désactivé.');
        }
    
        return $this->redirectToRoute('app_logout');
    }

   
    

}
