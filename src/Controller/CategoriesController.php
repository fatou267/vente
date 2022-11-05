<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use App\Entity\SousCategories;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//#[Route('/category', name: 'categories_')]
class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(CategoriesRepository $categories, SousCategoriesRepository  $sousCategories): Response
    {
        return $this->render('categories/index.html.twig', ['categories' => $categories->findBy([]),'sousCategories' => $sousCategories->findBy([])
    ]);
    }
}
