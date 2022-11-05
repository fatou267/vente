<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(CategoriesRepository $categories, SousCategoriesRepository  $sousCategories): Response
    {
        $user = $this->getUser();
        return $this->render('profil/index.html.twig', [
            'user' => $user,'categories' => $categories->findBy([]),'sousCategories' => $sousCategories->findBy([])
        ]);
    }
}
