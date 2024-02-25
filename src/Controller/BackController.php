<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    #[Route('/back-home', name: 'app_back')]
    public function index(): Response
    {
        return $this->render('back/index.html.twig', [
             
        ]);
    }
}
