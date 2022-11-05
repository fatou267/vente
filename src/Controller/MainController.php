<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use App\Entity\Produits;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(ProduitsRepository $produitsRepository, CategoriesRepository $categories, SousCategoriesRepository  $sousCategories): Response
    {
       // $sousCategories = $cate.getSousCategories();
        return $this->render('main/index.html.twig', ['produits' => $produitsRepository->findBy([], ['id' => 'asc']),
        'categories' => $categories->findBy([]), 'sousCategories' => $sousCategories->findBy([]) ]);
       // return $this->render('main/index.html.twig', ['produits' => $produitsRepository->findBy([], ['id' => 'asc'])]);
    }
    
}
 