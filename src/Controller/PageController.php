<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/page', name: 'app_')]
class PageController extends AbstractController
{
    #[Route('{slug}', name: 'page')]
    public function aboutAction(CategoriesRepository $categories, SousCategoriesRepository  $sousCategories): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController','categories' => $categories->findBy([]),'sousCategories' => $sousCategories->findBy([])
        ]);
    }
}
