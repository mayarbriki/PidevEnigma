<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Historique;
use App\Entity\Produit;

class BackController extends AbstractController
{
    #[Route('/back-home', name: 'app_back')]
    public function index(EntityManagerInterface $em ,): Response
    {
            if ($this->isGranted("ROLE_LIVREUR")) {
            return $this->render('back/index_livreur.html.twig');
                }

        $month_query = $em->createQueryBuilder();
        $month_query->select('p.createdAt as createdAt', 'SUM(p.totale) as total')
            ->from('App\Entity\Historique', 'p')
            ->groupBy('p.createdAt')
            ->orderBy('p.createdAt', 'ASC');

        $data_month = $month_query->getQuery()->getResult();

        // Process the results
        $months = [];
        $totals = [];
         foreach ($data_month as $row) {
            $monthName = date('F', $row['createdAt']->getTimestamp()); // Extract month name from createdAt
            $months[] = $monthName;
            $totals[] = $row['total'];
        }
        
/////////////////////////////

$query = $em->createQuery(
    'SELECT c.libelle AS categoryName, count(p.id) AS somme
    FROM App\Entity\Produit p
    JOIN p.Categorys c
    GROUP BY c.libelle'
);


/////////////////////////////

$query = $em->createQuery(
    'SELECT c.libelle AS categoryName, count(p.id) AS somme
    FROM App\Entity\Produit p
    JOIN p.Categorys c
    GROUP BY c.libelle'
);
$totalProductsPerCategory = $query->getResult();

$produit = [];
$somme = [];
foreach ($totalProductsPerCategory as $row) {
    $produit[] = $row['categoryName'];
    $somme[] = $row['somme'];
}

$query = $em->createQuery(
    'SELECT u.email AS emails, SUM(c.totale) AS sumtot
    FROM App\Entity\User u
    JOIN u.commandes c
    GROUP BY u.email'
);

$ordersPerUser = $query->setMaxResults(10)->getResult();
;

$emails = [];
$somme2 = [];
foreach ($ordersPerUser as $row) {
    $emails[] = $row['emails'];
    $somme2[] = $row['sumtot'];
}

        return $this->render('back/index.html.twig', [
            'labels' => $months,
            'data' => $totals,

            'produit' => $produit,
            'somme' => $somme,
            
            'email' => $emails,
            'somme2' => $somme2,
        ]);
    }










}
