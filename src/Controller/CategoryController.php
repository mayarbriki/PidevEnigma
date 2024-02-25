<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;//controller
use Doctrine\Persistence\ManagerRegistry;//controller
use App\RepositoryCategoryRepository;//controller
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Repository\CategoryRepository;

 
class CategoryController extends AbstractController
{
    
   
    #[Route('/Category', name: 'appback2')]
    public function afficheback2(ManagerRegistry $em): Response
    {
        $repo=$em->getRepository(Category::class);
        $result=$repo->findAll();
        return $this->render ('category/back.html.twig',['Category'=>$result]);
   
       
    }




    #[Route('/Category/add', name: 'add2')]
    public function add2(ManagerRegistry $doctrine,Request $request): Response
    {
        $Category=new Category() ;
        $form=$this->createForm(CategoryType::class,$Category); 
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() )   
       {
        $em=$doctrine->getManager(); 
        $em->persist($Category); 
        $em->flush(); 
        return $this->redirectToRoute('appback2');
        }
        return $this->render('category/add.html.twig', array("formCategory"=>$form->createView()));
       

    }
   
    #[Route('/Category/update/{id}', name: 'update2')]

    public function  updateCategory2 (ManagerRegistry $doctrine,$id,  Request  $request) : Response
    { $Category = $doctrine
        ->getRepository(Category::class)
        ->find($id);
        $form = $this->createForm(CategoryType::class, $Category);
        $form->add('update2', SubmitType::class) ;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() )
        { $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('appback2');
        }
        return $this->renderForm("category/update.html.twig",
            ["Category"=>$form]) ;


    } 

    #[Route('/Category/delete/{id}', name: 'delete2')]

    public function delete2($id, ManagerRegistry $doctrine)
    {
        $category = $doctrine
            ->getRepository(Category::class)
            ->find($id);
    
        if (!$category) {
            throw $this->createNotFoundException('Category not found for id '.$id);
        }
    
        $em = $doctrine->getManager();
        $em->remove($category);
        $em->flush();
    
        return $this->redirectToRoute('appback2');
    }
    
}
