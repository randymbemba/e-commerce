<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheProduitController extends AbstractController
{
    #[Route('/fiche/produit', name: 'fiche_produit')]
    public function index(): Response
    {
        return $this->render('fiche_produit/index.html.twig', [
            'controller_name' => 'FicheProduitController',

        ]);
    }

    
    #[Route('/fiche/produit/{id}', name: 'idProd')]
    public function params(ProduitRepository $produitRepository,$id): Response
    {
        return $this->render('fiche_produit/test.html.twig', [
            'controller_name' => 'FicheProduitController',
            'produits' => $produitRepository->findBy(['id' => $id]),           
        ]);
    }

}
