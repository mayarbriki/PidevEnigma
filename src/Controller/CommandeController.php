<?php

namespace App\Controller;

use App\Entity\Historique;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 
 use App\Entity\Commande;
use App\Entity\Panier;
 use App\Repository\CommandeRepository;
 use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
 use Symfony\Bridge\Twig\Mime\TemplatedEmail;
 use Symfony\Component\HttpFoundation\Request;
 
 
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\NotifierInterface;
 
 

class CommandeController extends AbstractController
{
   
    
    /**
     * @Route ("/sent/{id}", name="sent")
     */
    public function new (Panier $panier ,  EntityManagerInterface $em): Response
    {

        $total = 0;
        foreach ($panier->getProduits() as $produit) {
            $total += $produit->getPrix();
        }

        $c = new Commande;
        $c->setPani($panier);
        $c->setTotale($total);
        $c->setUser($this->getUser());
        $c->setCreatedAt(new \DateTimeImmutable('now'));

        $em->persist($c);
        $em->flush();

        $h = new Historique;
        $h->setTotale($total);
        $h->setRefCommande($c->getId());
         $h->setUser($this->getUser() );
        $h->setCreatedAt(new \DateTimeImmutable('now'));

         
        
        $em->persist($h);
        $em->flush();

        foreach ($panier->getProduits() as $produit) {
            $panier->removeProduit($produit);


             $em->persist($panier);
        }
        $em->flush();


        return $this->redirectToRoute('app');
    }

    #[Route('/commande', name: 'app_commande')]
    public function index(CommandeRepository $cr): Response
    {
        return $this->render('commande/index.html.twig', [
            'commandes' => $cr->findAll(),
        ]);
    }
    #[Route('/commande-admin', name: 'app_commande_admin')]
    public function indexadmin(CommandeRepository $cr ,Request $request , PaginatorInterface $pg): Response
    {

        $pagination = $pg->paginate(

            $cr->findAll(),
            $request->query->get('page', 1),
            5
        );  



        return $this->render('commande/admin.html.twig', [
            'commandes' => $pagination,
        ]);
    }
    private $notifier;

   
    
    #[Route('/c/accepte/{id}', name: 'app_commande_accepte')]
    public function accepte(Commande $c ,MailerInterface $mailer ,EntityManagerInterface $em): Response
    {
      /*  // $email_user = $user->getUserIdentifier();
        $email = (new TemplatedEmail())
        ->from(new Address('admin@security-demo.com', 'Security'))
        //$c->getPani()->getUser()->getUserIdentifier()
        ->to("mayar@briki.com")
        ->subject('salutation')
        ->htmlTemplate('email/email.html.twig')
        ->context([])
    ;

    $mailer->send($email);
    return new Response('Email sent!');
*/
        $email = (new Email())
            ->from('your_email@example.com')
            ->to('recipient@example.com')
            ->subject('Hello from Symfony!')
            ->text('This is a test email sent from Symfony.');

        $mailer->send($email);
         $c->setSent(true);
        $em->persist($c);
        $em->flush();
return $this->redirectToRoute('app_commande_admin');
        
    }
    #[Route('/c/refuser/cmd/{id}', name: 'app_commande_refuser')]
    public function refuser(Commande $c , EntityManagerInterface $em): Response
    {
        $c->setSent(false);
        $em->persist($c);
        $em->flush();
return $this->redirectToRoute('app_commande_admin');
        
    }
      
}
