<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Message\SendEmailMessage;
use App\Entity\Livraison;

class EmailController extends AbstractController
{
    #[Route('/email', name: 'app_email')]
    public function affecter(MessageBusInterface $bus): Response
    {
        // Fetch user data from your database or any other source
        $livraisonId = 3; // Example user ID, replace this with the actual user ID
        $livraison = $this->getDoctrine()->getRepository(Livraison::class)->find($livraisonId);

        if (!$livraison) {
            throw $this->createNotFoundException('User not found');
        }

        $bus->dispatch(new SendEmailMessage($livraisonId));

        return $this->render('email/index.html.twig', [
            'controller_name' => 'EmailController',
        ]);
    }
}
