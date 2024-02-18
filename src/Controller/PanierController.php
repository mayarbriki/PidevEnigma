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
/**
     * @Route("/panier", name="panier")
     */
    public function index(PanierRepository $repository , Request $request): Response
    {
        $d = $repository->findBy(['utilisateur'=>1])[0];
        $sum = $d->getProduits()->count();
        $data = $d->getProduits()->toArray();
        $total=0.0;
        foreach ($data as $p){
            $total += ($p->getPrix() * $p->getQuantite());
        }
        //$newPanier = new Panier();
        $form = $this->createFormBuilder($d)
           // ->add("utilisateur",EntityType::class, ['class'=> User::class, 'choice_label' => 'nom'])
            ->add('produits',EntityType::class,[
                'class'=>Produit::class,
                'choice_label'=>'nom',
                'multiple'=>true,
                'mapped'=>false,
])
            ->add("Ajouter_produit",SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            foreach ($request->request->get('form')['produits'] as $PID){
                $produit = $this->getDoctrine()->getRepository(Produit::class)->find($PID);
                $d->addProduit($produit);
                $em->flush();
            }
           // dd($newPanier->getProduits());

             //$em->persist($newPanier);
            $em->flush();
            return $this->redirectToRoute('panier');
        }

        return $this->render('panier/index.html.twig', [
            'formP' => $form->createView(),'data' => $data , 'sumP'=>$sum , 'total'=>$total
        ]);
    }

   /**
     * @Route("/panierToCommande{idUtilisateur}", name="panierToCommande")
     */

     public function panierToCommande(CommandeProduitRepository $commandeProduitRepository,ProduitRepository $produitRepository,UserRepository $utilisateurRepository,$idUtilisateur ,PanierRepository $repository, Request $request): Response
     {
 
         $newCommande = new Commande();
         $prixTot=0;
         $panier = $repository->findBy(['utilisateur' => $idUtilisateur])[0];
         foreach($panier->getProduits()->toArray() as $p){
             $pr = $produitRepository->find($p->getId());
             $prixTot =$prixTot+ $pr->getPrix();
         }
         $newCommande->setUtilisateur($utilisateurRepository->find($idUtilisateur));
         $newCommande->setStatus("En Attente");
         $newCommande->setReference(random_bytes(10));
         $newCommande->setMontant($prixTot);
         $newCommande->setDateCreation(new \DateTime());
         $em = $this->getDoctrine()->getManager();
         $em->persist($newCommande);
         foreach($panier->getProduits()->toArray() as $p){
             $pr = $produitRepository->find($p->getId());
             $commandeProduit = new CommandeProduit();
             $commandeProduit->setCommande($newCommande);
             $commandeProduit->setProduit($pr);
             $commandeProduit->setQuantiteProduit($pr->getQuantite());
             $em->persist($commandeProduit);
             $newCommande->addCommandeProduit($commandeProduit);
             $pr->setQuantite(1);
             $panier->removeProduit($p);
             
         }
         $em->flush();
         return $this->redirectToRoute('commande');
     }
     /**
      * @Route("/removeP{id}", name="removeP")
      */
     public function removeP( $id,PanierRepository $repository , Request $request): Response
     {
         $d = $repository->findBy(['utilisateur'=>1])[0];
             $em = $this->getDoctrine()->getManager();
                 $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
                 $d->removeProduit($produit);
                 $produit->setQuantite(1);
                 $em->flush();
 
             // dd($newPanier->getProduits());
 
             //$em->persist($newPanier);
 
             return $this->redirectToRoute('panier');
 
 
 
     }
   
}
