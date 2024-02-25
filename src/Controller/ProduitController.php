<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;//controller
use Doctrine\Persistence\ManagerRegistry;//controller
use App\RepositoryProduitRepository;//controller
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\String\Slugger\SluggerInterface;

use App\Repository\PanierRepository;
use App\Entity\Panier;
use App\Entity\User;
use App\Entity\Commande;
use App\Entity\CommandeProduit;
use App\Repository\CommandeProduitRepository;
use App\Repository\UserRepository;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProduitController extends AbstractController
{
    
   
    #[Route('/produit', name: 'app')]
    public function affiche1(ProduitRepository $pr, Request $request ,PaginatorInterface $pg): Response
    {

        $pagination = $pg->paginate(

            $pr->findAll(),
            $request->query->get('page', 1),
            3
        );    
           if (!$this->isGranted('ROLE_ADMIN')) {

        

        return $this->render ('produit/affich.html.twig',[    'pagination'=>$pagination]);
    }else{
    return $this->render ('produit/back.html.twig',[  'pagination'=>$pagination]);
}
   
       
    }
  /*  #[Route('/produit/afficherback', name: 'appback')]
    public function afficheback(ManagerRegistry $em): Response
    {
        $repo=$em->getRepository(Produit::class);
        $result=$repo->findAll();
        return $this->render ('Produit/back.html.twig',['Produit'=>$result]);
   
       
    }
*/



   
    #[Route('/produit/add', name: 'add1')]
    public function add1(ManagerRegistry $doctrine,Request $request, SluggerInterface $slugger): Response
    {
        $Produit=new Produit() ;
        $form=$this->createForm(ProduitType::class,$Produit); //sna3na objet essmo form aamlena bih appel lel Produittype
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() )   //amaalna verification esq taadet willa le aadna prob fi code ou nn
       {
        $image = $form->get('image')->getData();

        // this condition is needed because the 'brochure' field is not required
        // so the PDF file must be processed only when a file is uploaded
        if ($image) {
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $image->move(
                    $this->getParameter('produit_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'brochureFilename' property to store the PDF file name
            // instead of its contents
            $Produit->setImage($newFilename);
        }
        $em=$doctrine->getManager(); //appel lel manager
        $em->persist($Produit); //elli tzid
        $em->flush(); //besh ysob fi base de donnee
        return $this->redirectToRoute('app');
        }
        return $this->render('Produit/add.html.twig', array("formProduit"=>$form->createView()));
       // return $this->render('Produit/add.html.twig', array("formProduit"=>$form->createView));

    }

    #[Route('/produit/update/{id}', name: 'update')]

    public function  updateProduit (ManagerRegistry $doctrine,$id,  Request  $request) : Response
    { $Produit = $doctrine
        ->getRepository(Produit::class)
        ->find($id);
        $form = $this->createForm(ProduitType::class, $Produit);
        $form->add('update', SubmitType::class) ;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() )
        { $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('appback');
        }
        return $this->renderForm("Produit/update.html.twig",
            ["Produit"=>$form]) ;


    } 

    #[Route('/produit/delete/{id}', name: 'delete')]

    public function delete($id, ManagerRegistry $doctrine)
    {$c = $doctrine
        ->getRepository(Produit::class)
        ->find($id);
        $em = $doctrine->getManager();
        $em->remove($c);
        $em->flush() ;
        return $this->redirectToRoute('appback');
    }
    #[Route('/produit/statistics', name: 'product_statistics')]
    public function productStatistics(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $repository = $entityManager->getRepository(Produit::class);

        // Get total number of products
        $totalProducts = $repository->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->getQuery()
            ->getSingleScalarResult();

        // Get average price of products
        $averagePrice = $repository->createQueryBuilder('p')
            ->select('AVG(p.prix)')
            ->getQuery()
            ->getSingleScalarResult();

        // Get highest priced product
        $highestPricedProduct = $repository->createQueryBuilder('p')
            ->orderBy('p.prix', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        // Get lowest priced product
        $lowestPricedProduct = $repository->createQueryBuilder('p')
            ->orderBy('p.prix', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        // Render the Twig template with the statistics data
        return $this->render('produit/statistics.html.twig', [
            'total_products' => $totalProducts,
            'average_price' => $averagePrice,
            'highest_priced_product' => $highestPricedProduct,
            'lowest_priced_product' => $lowestPricedProduct,
        ]);
    }
}
