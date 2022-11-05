<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Users;

class UsersFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder)
    {} 
    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('fngalmaktum@gmail.com');
        $admin->setNom('Niang');
        $admin->setPrenom('Fatou');
        $admin->setPassword($this->passwordEncoder->hashPassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        $manager->flush();
    }

}
