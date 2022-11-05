<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier', name: 'panier_')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitsRepository $produitsRepository,CategoriesRepository $categories, SousCategoriesRepository  $sousCategories): Response
    {
        $panier = $session->get("panier",[]);

        $dataPanier = [];
        $total = 0;
        foreach($panier as $id => $quantite)
        {
           $produit= $produitsRepository->find($id);
            $dataPanier[] = [
                "produit" => $produit,
                "quantite" => $quantite
            ];
            $total += $produit->getPrix() * $quantite;
        }
        return $this->render('panier/index.html.twig', compact("dataPanier", "total","categories","sousCategories"));
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Produits $produit, SessionInterface $session)
    {
         $panier = $session->get("panier", []);

         $id = $produit->getId();

         if(!empty($panier[$id]))
         {
            $panier[$id]++;
         }
         else
            $panier[$id] = 1;

        $session->set("panier", $panier);

        return $this->redirectToRoute('panier_index');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produits $produit, SessionInterface $session)
    {
         $panier = $session->get("panier", []);

         $id = $produit->getId();

         if(!empty($panier[$id]))
         {
            if($panier[$id] > 1)
                $panier[$id]--;
            else
                unset($panier[$id]);
         }

        $session->set("panier", $panier);

        return $this->redirectToRoute('panier_index');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produits $produit, SessionInterface $session)
    {
         $panier = $session->get("panier", []);

         $id = $produit->getId();

         if(!empty($panier[$id]))
         {
            unset($panier[$id]);
         }

        $session->set("panier", $panier);

        return $this->redirectToRoute('panier_index');
    }

    #[Route('/delete', name: 'delete_all')]
    public function deleteAll(SessionInterface $session)
    {
    
        $session->set("panier", []);

        return $this->redirectToRoute('panier_index');
    }

   
}
