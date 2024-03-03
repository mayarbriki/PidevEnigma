<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\Query\ResultSetMapping;
use DateTime; 
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ReclamationController extends AbstractController
{ 
    #[Route("/submit_reclamation", name:"submit_reclamation", methods: ['POST'])]
          
    public function submitReclamation(Request $request): Response
    {
        $titre = $request->request->get('titre');
        //$dateR = $request->request->get('dateR');
        $descriptionR = $request->request->get('descriptionR');
        
        
        // Créez une instance de l'entité Reclamation avec les données soumises par le formulaire
        $reclamation = new Reclamation();
        $reclamation->setTitre($request->request->get('titre'));
        $reclamation->setDescriptionR($request->request->get('descriptionR'));
        // Définissez le statut initial de la réclamation
        $reclamation->setStatusR('Nouvelle');
         // Définissez la date de création de la réclamation comme la date actuelle
         $reclamation->setDateR(new \DateTime());
        

        // Enregistrez la réclamation dans la base de données
       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();
           
           

        // Redirigez l'utilisateur vers la page d'affichage des réclamations
        return $this->redirectToRoute('showrec', ['id' => $reclamation->getId()]);
    }
    #[Route('/reclamationadmin', name: 'app_reclamation_admin', methods: ['GET'])]
    public function indexAdmin(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/adminrec.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }
    #[Route('/reclamation', name: 'app_reclamation', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }
    
   


   

     /**
     * @Route("/{id}", name="reclamation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation', [], Response::HTTP_SEE_OTHER);
    }

    


    /******************affichage Reclamation*****************************************/

   
    public function allRecAction()
    {

        $reclamation = $this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findAll();
        return $this->json($reclamation,200,[],['groups'=>'reclamation:read']);

    }


   
    
    #[Route('/newr', name: 'app_Add', methods: ['GET', 'POST'])]
    public function Add(Request $request): Response
    {
        $reclamation = new reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->add('Ajouter', SubmitType::class);
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            
    
            
           
        }
    
        return $this->render('reclamation/new.html.twig', ['f' => $form->createView()]);
    }
    #[Route('/showrec/{id}', name: 'showrec', methods: ['GET'])]
    public function afficherReclamations($id): Response
    {
        // Récupérez toutes les réclamations depuis la base de données
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
      // Affichez les réclamations dans un tableau
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
    #[Route('/showadmin/{id}', name: 'showadmin', methods: ['GET'])]
    public function afficher($id): Response
    {
        // Récupérez toutes les réclamations depuis la base de données
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
      // Affichez les réclamations dans un tableau
        return $this->render('reclamation/adminshow.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
    /**
     * @Route("/consultation-reclamation", name="consultation_reclamation", methods={"GET"})
     */
    public function consultationReclamation(Request $request): Response
    {
        // Récupérer l'ID de la réclamation depuis la requête
        $id = $request->query->get('id');

        // Récupérer la réclamation depuis la base de données en fonction de son ID
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);

        // Rendre la vue Twig avec les détails de la réclamation
        return $this->render('reclamation/consultation.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }


    
    
    /**
     * @Route("/{id}/edit", name="reclamation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamation $reclamation , EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder($reclamation)
        ->add('titre', TextType::class)
        ->add('descriptionR', TextareaType::class)
        ->getForm();

    $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }
    }


