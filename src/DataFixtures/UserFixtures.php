<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setEmail('user@monsite.com');

        $user->setFirstname('user');

        $user->setLastname('user');

        $user->setNickname('user');

        $user->setRoles(['ROLE_USER']);

        $user->setPassword($this->passwordEncoder->encodePassword(

            $user,

            'user'

        ));


        $manager->persist($user);

        // Création d’un utilisateur de type “administrateur”

        $admin = new User();

        $admin->setEmail('admin@monsite.com');

        $admin->setFirstname('admin');

        $admin->setLastname('admin');

        $admin->setNickname('WaneVeal');

        $admin->setRoles(['ROLE_ADMIN']);

        $admin->setPassword($this->passwordEncoder->encodePassword(

            $admin,

            'admin'

        ));


        $manager->persist($admin);


        // Sauvegarde des 2 nouveaux utilisateurs :

        $manager->flush();
    }
}
