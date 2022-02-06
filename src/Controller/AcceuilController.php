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
            'produits' => $produitRepository->findAll(),
        ]);
    }


    #[Route('/{id}/editProd', name: 'editProd', methods: ['GET', 'POST'])]
    public function edit(Produit $produit, Request $request,EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'success',
                '<i data-feather="check"></i> Le produit a bien été mofifier'
            );
            return $this->redirectToRoute('acceuil', [], Response::HTTP_SEE_OTHER);
        }
        else{
            $this->addFlash(
                'danger',
                'Le produit n\'a pas été modifié'
            ); 
        }
        return $this->render('acceuil/editProd.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    #[Route('/ajoueProd', name: 'ajoueProd')]
    public function add(Request $request,EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {

            if ($form->isValid()){
                $entityManager->persist($produit);
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    'Le produit a été ajouté'
                );

                return $this->redirectToRoute('acceuil', [], Response::HTTP_SEE_OTHER);
            }
            else{
                $this->addFlash(
                    'danger',
                    'Le produit n\'a pas été ajouté'
                ); 
            }
        }

        return $this->renderForm('acceuil/addProd.html.twig', [
            "form" => $form,
        ]);
    }

    #[Route('/{id}/deleteProd', name: 'deleteProd')]
    public function delete(Produit $produit, Request $request,EntityManagerInterface $entityManager): Response
    {
        if ($produit) {
            $entityManager->remove($produit);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Le produit a été supprimé'
            ); 

            return $this->redirectToRoute('acceuil');
        }
        else{
            $this->addFlash(
                'danger',
                'Le produit n\'a pas été supprimer'
            ); 

            return $this->redirectToRoute('acceuil');
        }

    }
}
