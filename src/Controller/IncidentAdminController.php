<?php




namespace App\Controller;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Incident;
use App\Form\StatutIncidentType;
use App\Repository\IncidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; // <= AJOUT ICI
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ServiceIntervention;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class IncidentAdminController extends AbstractController
{
#[Route('/admin/incident', name: 'app_admin_home')]
public function index(IncidentRepository $incidentRepository): Response
{
    $incidents = $incidentRepository->findAll();

    // Comptage par niveau de danger (de 0 à 3)
    $countByDanger = [
        0 => 0, // Faible
        1 => 0, // Moyen
        2 => 0, // Élevé
        3 => 0, // Critique (si utilisé)
    ];

    foreach ($incidents as $incident) {
        $level = $incident->getDangerLevel(); // Assure-toi que c’est un entier entre 0-3
        if (isset($countByDanger[$level])) {
            $countByDanger[$level]++;
        }
    }

    return $this->render('back/home/index.html.twig', [
        'incidents' => $incidents,
        'countByDanger' => $countByDanger,
    ]);
}

   // Assure-toi que la route suivante est correcte
   #[Route('/incident/{id}/editstatu', name: 'incident_editstatu')]
   public function editStatut(
       Incident $incident,
       Request $request,
       EntityManagerInterface $entityManager,
       MailerInterface $mailer,
       ParameterBagInterface $params
   ): Response {
       $form = $this->createForm(StatutIncidentType::class, $incident);
       $form->handleRequest($request);
   
       if ($form->isSubmitted() && $form->isValid()) {
           if ($incident->getServiceAffecte() !== null) {
               if ($incident->getStatut() === 'Résolu') {
                   $incident->setDateResolution(new \DateTime());
                   $citoyen = $incident->getUser();
   
                   // 🔽 Chemin absolu vers l'image stockée localement
                   $imageFilename = $incident->getImage(); // adapte selon ta méthode (ex : getImageName())
                   $imagePath = $params->get('kernel.project_dir') . '/public/uploads/' . $imageFilename;
   
                   // Prépare l'email
                   $email = (new Email())
                       ->from('mouradmissaoui76@gmail.com')
                       ->to($citoyen->getEmail())
                       ->subject('🛠️ Incident résolu - Merci pour votre signalement')
                       ->priority(Email::PRIORITY_HIGH);
   
                   // Si l’image existe, on l’intègre dans le contenu du mail
                   if ($imageFilename && file_exists($imagePath)) {
                       $email->embedFromPath($imagePath, 'incident_image');
   
                       // Design du mail
                       $email->html("
                           <div style=\"font-family: Arial, sans-serif; font-size: 16px; color: #333; line-height: 1.6;\">
                               <div style=\"background-color: #f4f7fb; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);\">
                                   <p style=\"font-size: 18px; font-weight: bold; color: #4CAF50;\">Bonjour <strong>{$citoyen->getPrenom()} {$citoyen->getNom()}</strong>,</p>
                                   <p>Nous avons le plaisir de vous informer que l'incident que vous avez signalé a été <span style=\"color: #28a745;\"><strong>résolu avec succès</strong></span>.</p>
   
                                   <hr style=\"border: none; border-top: 1px solid #ddd;\" />
   
                                   <p><strong>📋 Description :</strong> {$incident->getDescription()}</p>
                                   <p><strong>📌 Type d'incident :</strong> {$incident->getTypeIncident()}</p>
                                   <p><strong>📅 Résolu le :</strong> " . $incident->getDateResolution()->format('d/m/Y H:i') . "</p>
                                   
                                   <hr style=\"border: none; border-top: 1px solid #ddd;\" />
   
                                   <div style=\"text-align: center; margin-top: 20px;\">
                                       <p><strong>📷 Image de l'incident :</strong></p>
                                       <img src=\"cid:incident_image\" alt=\"Image Incident\" style=\"max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #ddd; margin-top: 15px;\" />
                                   </div>
   
                                   <hr style=\"border: none; border-top: 1px solid #ddd;\" />
   
                                   <p>Merci beaucoup pour votre vigilance et votre contribution à l'amélioration de notre service. 🙏</p>
                                   <p style=\"margin-top: 30px; font-style: italic; color: #888;\">Cordialement,<br><strong>L'équipe de gestion des incidents</strong></p>
                               </div>
                           </div>
                       ");
                   } else {
                       // Si l'image est absente
                       $email->html("
                           <div style=\"font-family: Arial, sans-serif; font-size: 16px; color: #333; line-height: 1.6;\">
                               <div style=\"background-color: #f4f7fb; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);\">
                                   <p style=\"font-size: 18px; font-weight: bold; color: #4CAF50;\">Bonjour <strong>{$citoyen->getPrenom()} {$citoyen->getNom()}</strong>,</p>
                                   <p>L'incident que vous avez signalé a été <span style=\"color: #28a745;\"><strong>résolu avec succès</strong></span>, mais aucune image n'est disponible pour cette résolution.</p>
   
                                   <hr style=\"border: none; border-top: 1px solid #ddd;\" />
   
                                   <p><strong>📋 Description :</strong> {$incident->getDescription()}</p>
                                   <p><strong>📌 Type d'incident :</strong> {$incident->getTypeIncident()}</p>
                                   <p><strong>📅 Résolu le :</strong> " . $incident->getDateResolution()->format('d/m/Y H:i') . "</p>
   
                                   <hr style=\"border: none; border-top: 1px solid #ddd;\" />
   
                                   <p>Merci beaucoup pour votre vigilance et votre contribution à l'amélioration de notre service. 🙏</p>
                                   <p style=\"margin-top: 30px; font-style: italic; color: #888;\">Cordialement,<br><strong>L'équipe de gestion des incidents</strong></p>
                               </div>
                           </div>
                       ");
                   }
   
                   $mailer->send($email);
               }
   
               $entityManager->flush();
               $this->addFlash('success', 'Le statut de l\'incident a été mis à jour.');
               return $this->redirectToRoute('app_admin_home');
           } else {
               $this->addFlash('error', 'Vous devez d\'abord affecter un service avant de modifier le statut.');
           }
       }
   
       return $this->render('back/home/edit.html.twig', [
           'form' => $form->createView(),
           'incident' => $incident,
       ]);
   }
  

}

    

