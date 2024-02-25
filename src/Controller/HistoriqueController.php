<?php

namespace App\Controller;

use App\Repository\HistoriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
    #[Route('/historique', name: 'app_historique')]
    public function index(HistoriqueRepository $hr ): Response
    {
        return $this->render('historique/index.html.twig', [
            'histo' => $hr->findAll(),
        ]);
    }
}
