<?php

namespace App\Controller;


use App\Repository\UsersRepository;
use App\Repository\CommandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use App\Entity\Commandes;
use App\Entity\Users;
use App\Entity\Details;
use App\Repository\ProduitsRepository;
//use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/commandes', name: 'commandes_')]
class CommandesController extends AbstractController
{
    #[Route('/commandes', name: 'app_commandes')]
    public function index(SessionInterface $session, ProduitsRepository $produitsRepository, ManagerRegistry $doctrine,CategoriesRepository $categories, SousCategoriesRepository  $sousCategories): Response
    {

        $manager = $doctrine->getManager();
        $panier = $session->get("panier", []);
        
        $user = $this->getUser();
        if (empty($user)) {
           return $this->redirectToRoute("app_register");
        }
        $total=0;
        $pro = [];
        //echo $user['id'];
       

        if(empty($panier))
        {
           return $this->redirectToRoute("main");
        }
        foreach($panier as $id => $quantite)
        {
           $produit= $produitsRepository->find($id);
           $pro[] = [
                "produit" => $produit,
                "quantite" => $quantite
            ];
           $total += $produit->getPrix() * $quantite;
        }
        $commandes = new Commandes();

        $commandes->setUsers($user);
        $commandes->setPrixtotal($total);

        $manager->persist($commandes);

        $manager->flush();

        $session->set("panier", []);
        foreach ($pro as $key => $value )
        {
            $details =  new Details();
            $commandes->addDetail($details);
            $value['produit']->addDetail($details);
            $details->setQuantite($value['quantite']);
            $details->setPrixUnit($value['produit']->getPrix());

            $manager->persist($details);

            $manager->flush();
        }

        return $this->render('commandes/index.html.twig', compact("user", "total", "commandes","categories","sousCategories"));
    }


}
