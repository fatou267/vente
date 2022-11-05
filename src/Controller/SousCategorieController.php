<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\SousCategoriesRepository;
use App\Entity\SousCategories;
use App\Repository\CategoriesRepository;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sous/categorie', name: 'app_sous_')]
class SousCategorieController extends AbstractController
{
    #[Route('/{id}', name: 'categorie')]
    public function index(SousCategories $souscategorie,CategoriesRepository $categories, SousCategoriesRepository  $sousCategories): Response
    {
        $produits = $souscategorie->getProduits();
        return $this->render('sous_categorie/index.html.twig', compact('souscategorie','produits','categories','sousCategories')
        );
    }
}
