<?php

namespace App\Controller;

use App\Entity\Transport;
use App\Form\Transport1Type;
use App\Repository\TransportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/transport')]
class TransportController extends AbstractController
{
    #[Route('/', name: 'app_transport_index', methods: ['GET'])]
    public function index(Request $request, TransportRepository $transportRepository): Response
    {
        // Default sorting parameters
        $sortBy = $request->query->get('sort_by', 'id');
        $order = $request->query->get('order', 'ASC');

        // Fetch livraisons from the repository with sorting
        $transports = $transportRepository->findBy([], [$sortBy => $order]);

        $query = $request->query->get('query');

        if ($query) {
            // Perform search using repository method
            $searchResults = $transportRepository->search($query);
            // Overwrite livraisons with search results
            $transports = $searchResults;
        } else {
            // If no search query, load default data for dashboard
            $searchResults = [];
        }


        return $this->render('transport/index.html.twig', [
            'transports' => $transports,
            'searchResults' => $searchResults,
            'sortBy' => $sortBy,
            'order' => $order,
        ]);
    }

    #[Route('/afficher_transport', name: 'aff_transport_index1', methods: ['GET'])]
    public function index1(Request $request, TransportRepository $transportRepository, PaginatorInterface $paginator): Response
    {
        // Default sorting parameters
        $sortBy = $request->query->get('sort_by', 'id');
        $order = $request->query->get('order', 'ASC');

        
        // Fetch livraisons from the repository with sorting
        $transports = $transportRepository->findBy([], [$sortBy => $order]);

        $query = $request->query->get('query');
        if ($query) {
            // Perform search using repository method
            $searchResults = $transportRepository->search($query);
            // Overwrite livraisons with search results
            $transports = $searchResults;
        } else {
            // If no search query, load default data for dashboard
            $searchResults = [];
        }

        //pagination 
        $pagination = $pg->paginate(

            $transportRepository->findAll(),
            $request->query->get('page', 1),3); 

        return $this->render('transport/index1.html.twig', [
            'transports' => $transports,
            'searchResults' => $searchResults,
            'sortBy' => $sortBy,
            'order' => $order,
            'pagination'=>$pagination
        ]);
    }

    #[Route('/new', name: 'app_transport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $transport = new Transport();
        $form = $this->createForm(Transport1Type::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($transport);
            $entityManager->flush();

            return $this->redirectToRoute('app_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transport/new.html.twig', [
            'transport' => $transport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transport_show', methods: ['GET'])]
    public function show(Transport $transport): Response
    {
        return $this->render('transport/show.html.twig', [
            'transport' => $transport,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_transport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transport $transport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Transport1Type::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transport/edit.html.twig', [
            'transport' => $transport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transport_delete', methods: ['POST'])]
    public function delete(Request $request, Transport $transport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transport->getId(), $request->request->get('_token'))) {
            $entityManager->remove($transport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_transport_index', [], Response::HTTP_SEE_OTHER);
    }
}
