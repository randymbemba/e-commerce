<?php

namespace App\Controller;

use http\Env\Request;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    #[Route('/', name: 'acceuil_index')]
    public function index(ProduitRepository $ProduitRepository)
    {
        return $this->render('acceuil/index.html.twig', [
            'products' => $ProduitRepository->findAll()
        ]);
    }

    public function add($id, Request $request){
        $session = $request->getSession();

        $panier = $session->get('panier', []);

        $panier[$id]=1;

        $session->set('panier',$panier);

        dump($session->get('panier'));

    }
}
