<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    #[Route('/', name: 'acceuil')]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
            'produits' => $produitRepository->findBy(['id' => 1]),
        ]);
    }

    #[Route('/displayProd', name: 'displayProd')]
    public function display(ProduitRepository $produitRepository): Response
    {
        return $this->render('acceuil/displayProd.html.twig', [
            'produits' => $produitRepository->findBy(['id' => 0]),
        ]);
    }

    #[Route('/ajoueProd', name: 'ajoueProd')]
    public function add(Request $request,EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('acceuil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acceuil/addProd.html.twig', [
            "form" => $form,
        ]);
    }
}
