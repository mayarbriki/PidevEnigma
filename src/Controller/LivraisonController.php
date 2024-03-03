<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Livraison;
use App\Form\Livraison1Type;
use App\Form\Livraison2Type;
use App\Repository\LivraisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Transport;
use Knp\Component\Pager\PaginatorInterface;
use Twilio\Rest\Client;


#[Route('/livraison')]
class LivraisonController extends AbstractController
{
    #[Route('/', name: 'app_livraison_index', methods: ['GET'])]
    public function index(Request $request, LivraisonRepository $livraisonRepository, PaginatorInterface $pg): Response
    {
        // Default sorting parameters
        $sortBy = $request->query->get('sort_by', 'id');
        $order = $request->query->get('order', 'ASC');

        // Fetch livraisons from the repository with sorting
        $livraisons = $livraisonRepository->findBy([], [$sortBy => $order]);

        $query = $request->query->get('query');

        if ($query) {
            // Perform search using repository method
            $searchResults = $livraisonRepository->search($query);
            // Overwrite livraisons with search results
            $livraisons = $searchResults;
        } else {
            // If no search query, load default data for dashboard
            $searchResults = [];
        }

        $pagination = $pg->paginate(

            $livraisonRepository->findAll(),
            $request->query->get('page', 1),
            2
        );

        return $this->render('livraison/index.html.twig', [
            'livraisons' => $livraisons,
            'searchResults' => $searchResults,
            'sortBy' => $sortBy,
            'order' => $order,
            'livraisons'=>$pagination
        ]);
    }

    #[Route('/liv', name: 'app_liv', methods: ['GET'])]
    public function index2(Request $request, LivraisonRepository $livraisonRepository, EntityManagerInterface $entityManager, PaginatorInterface $pg): Response
    {
        // Default sorting parameters
        $sortBy = $request->query->get('sort_by', 'id');
        $order = $request->query->get('order', 'ASC');

        // Fetch livraisons from the repository with sorting
        $livraisons = $livraisonRepository->findBy([], [$sortBy => $order]);
        

        $query = $request->query->get('query');

        if ($query) {
            // Perform search using repository method
            $searchResults = $livraisonRepository->search($query);
            // Overwrite livraisons with search results
            $livraisons = $searchResults;
        } else {
            // If no search query, load default data for dashboard
            $searchResults = [];
        }

        $user = $this->getUser();
    
    // Fetch the Transport associated with the current user (Livreur)
    $transport = $entityManager->getRepository(Transport::class)->findOneBy(['livreur' => $user]);
        
    $livraison = new Livraison();

    // Set the Livreur and Matricule based on the fetched Transport
    if ($transport) {
        $livraison->setLivreur($transport->getLivreur());
        $livraison->setMatricule($transport);
    }

    $pagination = $pg->paginate(

        $livraisonRepository->findAll(),
        $request->query->get('page', 1),
        3
    );

        return $this->render('livraison/index2.html.twig', [
            'livraisons' => $livraisons,
            'searchResults' => $searchResults,
            'sortBy' => $sortBy,
            'order' => $order,
            'livraisons'=>$pagination
        ]);
    }

    #[Route('/affecter', name: 'aff_livraison_index', methods: ['GET'])]
    public function index1(Request $request, LivraisonRepository $livraisonRepository): Response
    {
        // Default sorting parameters
        $sortBy = $request->query->get('sort_by', 'id');
        $order = $request->query->get('order', 'ASC');

        // Fetch livraisons from the repository with sorting
        $livraisons = $livraisonRepository->findBy([], [$sortBy => $order]);

        $query = $request->query->get('query');

        if ($query) {
            // Perform search using repository method
            $searchResults = $livraisonRepository->search($query);
            // Overwrite livraisons with search results
            $livraisons = $searchResults;
        } else {
            // If no search query, load default data for dashboard
            $searchResults = [];
        }

        return $this->render('livraison/index1.html.twig', [
            'livraisons' => $livraisons,
            'searchResults' => $searchResults,
            'sortBy' => $sortBy,
            'order' => $order,
        ]);
    }


    #[Route('/new/{id}', name: 'app_livraison_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Commande $commade,EntityManagerInterface $entityManager): Response
    {
        $livraison = new Livraison();
        $form = $this->createForm(Livraison1Type::class, $livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $livraison->setReference($commade);
            $livraison->setDateLiv(new \DateTime('now'));
            $entityManager->persist($livraison);
            $entityManager->flush();

            return $this->redirectToRoute('app_livraison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livraison/new.html.twig', [
            'livraison' => $livraison,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_livraison_show', methods: ['GET'])]
    public function show(Livraison $livraison): Response
    {
        return $this->render('livraison/show.html.twig', [
            'livraison' => $livraison,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_livraison_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livraison $livraison, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Livraison1Type::class, $livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_livraison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livraison/edit.html.twig', [
            'livraison' => $livraison,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/affecter', name: 'aff_livraison_edit', methods: ['GET', 'POST'])]
    public function edit1(Request $request, Livraison $livraison, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
    
    // Fetch the Transport associated with the current user (Livreur)
    $matricule = $entityManager->getRepository(Transport::class)->findOneBy(['livreur' => $user]);
        
    

    // Set the Livreur and Matricule based on the fetched Transport
    

        $form = $this->createForm(Livraison2Type::class, $livraison);
        $form->handleRequest($request);

        

        if ($form->isSubmitted() && $form->isValid()) {
            if ($matricule) {
                $livraison->setLivreur($matricule->getLivreur());
                $livraison->setMatricule($matricule);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_liv', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livraison/edit1.html.twig', [
            'livraison' => $livraison,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_livraison_delete', methods: ['POST'])]
    public function delete(Request $request, Livraison $livraison, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livraison->getId(), $request->request->get('_token'))) {
            $entityManager->remove($livraison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_livraison_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/generate-pdf', name: 'livraison_generate_pdf')]
    public function generatePdf(Livraison $livraison): Response
    {
        // Get the HTML content of the page you want to convert to PDF
        $html = $this->renderView('livraison/show-pdf.html.twig', [
            // Pass any necessary data to your Twig template
            'livraison' => $livraison,
        ]);

        // Configure Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        
        // Instantiate Dompdf with the configured options
        $dompdf = new Dompdf($options);
        
        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);
        
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        
        // Set response headers for PDF download
        $response = new Response($dompdf->output());
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename="livraison.pdf"');

        return $response;
    }

    #[Route('/send-sms', name: 'send_sms')]
    public function sendSms(Client $twilioClient): Response
    {
        // Get the recipient's phone number and the message from your form or database
        $recipientPhoneNumber = '+21641703090'; // Replace with the recipient's phone number
        $message = 'Hello from Twilio!';

        try {
            // Send the SMS message using Twilio
            $twilioClient->messages->create(
                $recipientPhoneNumber,
                [
                    'from' => '%+21641703090%',
                    'body' => $message,
                ]
            );

            // Handle successful message delivery
            return new Response('SMS sent successfully!');
        } catch (\Exception $e) {
            // Handle errors
            return new Response('Error: ' . $e->getMessage());
        }
    }
}
