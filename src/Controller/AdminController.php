<?php

namespace App\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\LoginAttemptRepository;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/users', name: 'admin_users')]
public function index(Request $request, UtilisateurRepository $userRepository): Response
{
    $search = $request->query->get('search');

    if ($search) {
        $users = $userRepository->searchByNomOrEmail ($search);
    } else {
        $users = $userRepository->findAll();
    }

    return $this->render('admin/users.html.twig', [
        'users' => $users,
        'search' => $search,
    ]);
}


    #[Route('/user/activate/{id}', name: 'admin_user_activate')]
    public function activateUser($id, UtilisateurRepository $userRepository, EntityManagerInterface $em): RedirectResponse
    {
        $user = $userRepository->find($id);

        if ($user) {
            $user->setActiver(1);
            $em->flush();
            $this->addFlash('success', 'Utilisateur activé avec succès.');
        }

        return $this->redirectToRoute('admin_users');
    }

    #[Route('/user/deactivate/{id}', name: 'admin_user_deactivate')]
    public function deactivateUser($id, UtilisateurRepository $userRepository, EntityManagerInterface $em): RedirectResponse
    {
        $user = $userRepository->find($id);

        if ($user) {
            $user->setActiver(0);
            $em->flush();
            $this->addFlash('success', 'Utilisateur désactivé avec succès.');
        }

        return $this->redirectToRoute('admin_users');
    }

    #[Route('/user/delete/{id}', name: 'admin_user_delete')]
    public function deleteUser($id, UtilisateurRepository $userRepository, EntityManagerInterface $em): RedirectResponse
    {
        $user = $userRepository->find($id);

        if ($user) {
            $em->remove($user);
            $em->flush();
            $this->addFlash('success', 'Utilisateur supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_users');
    }

    #[Route('/admin/users/pdf', name: 'admin_users_pdf')]
    public function generatePdf(UtilisateurRepository $repo, Request $request): Response
    {
        $search = $request->query->get('search');
    
        if ($search) {
            $users = $repo->createQueryBuilder('u')
                ->where('u.nom LIKE :search OR u.prenom LIKE :search OR u.email LIKE :search')
                ->setParameter('search', '%' . $search . '%')
                ->getQuery()
                ->getResult();
        } else {
            $users = $repo->findAll();
        }
    
        // Configure Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
    
        // Render Twig into HTML
        $html = $this->renderView('admin/users_pdf.html.twig', [
            'users' => $users
        ]);
    
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="utilisateurs.pdf"'
        ]);
    }


    #[Route('/dashboard', name: 'app_admin_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }


    #[Route('/statistiques', name: 'admin_statistiques')]
public function statistiques(): Response
{
    return $this->render('admin/statistiques.html.twig');
}
#[Route('/login-attempts', name: 'admin_login_attempts')]
public function showLoginAttempts(LoginAttemptRepository $repo): Response
{
    $logs = $repo->findRecent();
    return $this->render('admin/login_attempts.html.twig', [
        'logs' => $logs
    ]);
}

}
