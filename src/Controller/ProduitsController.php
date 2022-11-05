<?php

namespace App\Controller;



use App\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/products', name: 'products_')]
class ProduitsController extends AbstractController
{
    #[Route('/{id}', name: 'details')]
    public function details(Produits $produits,CategoriesRepository $categories, SousCategoriesRepository  $sousCategories): Response
    {
        return $this->render('produits/details.html.twig', ['produits' => $produits,
        'categories' => $categories->findBy([]), 'sousCategories' => $sousCategories->findBy([])]);
    }
}
