<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categories;


class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $this->ajouterCategories('Homme', $manager);
       $this->ajouterCategories('Femme', $manager);
       $this->ajouterCategories('Enfant', $manager);

        $manager->flush();
    }

    public function ajouterCategories(string $name, ObjectManager $manager)
    {
        $categories = new Categories();
        $categories->setNom($name);

        $manager->persist($categories);

        return $categories;
    }
}
