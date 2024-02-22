<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\user;
use App\Entity\Commande;
use App\Entity\Produit;
use App\Repository\CommandeRepository;
use App\Repository\PanierRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommandeController extends AbstractController
{
   
    //commentaire
    
    /**
     * @Route ("/commande", name="commande")
     */
    public function index(Request $req ,PanierRepository $panierRepository, CommandeRepository $repository): Response
    {
        $data = $repository->findBy(['utilisateur'=>1]);
        $d = $panierRepository->findBy(['utilisateur'=>1])[0];
        $sum = $d->getProduits()->count();
        $dataTarray = $d->getProduits()->toArray();
        $total=0.0;
        foreach ($dataTarray as $p){
            $total += ($p->getPrix() * $p->getQuantite());
        }
        return $this->render('commande/index.html.twig', [
            'data'=>$data , 'sumP'=>$sum , 'total'=>$total
        ]);
    }

    /**
     * @Route ("/commandeDelete/{id}", name="commandeDelete")
     */
    public function delete(CommandeRepository $repository , $id): Response
    {
        $comm =$repository->find($id) ;
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($comm);
        $manager->flush();
        //return new Response('suppression avec succes');
        return $this->redirectToRoute('commande');
    }



      
}
