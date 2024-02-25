<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Entity\Commande;
use App\Entity\CommandeProduit;
use App\Entity\Panier;
use App\Entity\Produit;
use App\Repository\CommandeProduitRepository;
use Symfony\Component\String\ByteString;
use App\Repository\UserRepository;
use App\Repository\CommandeRepository;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use function Sodium\randombytes_random16;
use Symfony\Component\HttpFoundation\Session\SessionInterface;





class PanierController extends AbstractController
{
   
    #[Route('/panier/{id}', name: 'panier')]
    public function index(Produit $produit ,PanierRepository $repository , EntityManagerInterface $em , Request $request): Response
    {
        if (!$this->getUser()) {
             return $this->redirectToRoute('app_login');  
        }
        $user = $this->getUser();
        $panier = $user->getPanier();
         if ($panier) {
            $panier->addProduit($produit);
            $em->flush();
        }else{
            $panier = new Panier;

            $panier->setUser($user);
            $panier->addProduit($produit);
            $em->persist($panier);
            $em->flush();
        }
        
       
       



       return $this->redirectToRoute('app');
    }

  
    #[Route('/panier/show/{id}', name: 'app_panier_show')]
     public function panierToCommande(Panier $panier): Response
     {
        
  
        return $this->render('panier/show.html.twig',[
            'panier'=>$panier
        ]);
    }
    #[Route('/panier/remove/produit/{id}', name: 'app_panier_remove')]
     public function removeproduit(Produit $p ,EntityManagerInterface $em): Response
     {
        $user = $this->getUser();

        $panier = $user->getPanier();
        $panier->removeProduit($p)  ;
        $em->flush();
  
        return $this->render('panier/show.html.twig',[
            'panier'=>$panier
        ]);
    }
     
    #[Route('/supprimer/le/panier/{id}', name: 'app_panier_supp_panier')]
    public function reset(Panier $panier ,EntityManagerInterface $em): Response
    {

        foreach ($panier->getProduits() as $produit) {
            $panier->removeProduit($produit);


             $em->persist($panier);
        }


       
        $em->flush();
        
        return $this->redirectToRoute('app');

       
   }

    
     
   
}
