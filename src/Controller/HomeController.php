<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
class HomeController extends AbstractController
{
    #[Route('', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/send', name: 'app_home')]
    public function send(MailerInterface $mailer): Response
    {
         $email = (new Email())
        ->from('your_email@example.com')
        ->to('recipient@example.com')
        ->subject('Hello from Symfony!')
        ->text('This is a test email sent from Symfony.');

    $mailer->send($email);

    return $this->render('email/email.html.twig'  ,[
        "email"=>$email
    ] );
}
    
}
