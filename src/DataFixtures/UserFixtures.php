<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\GetApiModel;
use App\Entity\CryptoMonnaie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager){
/*
            $apiUser = new GetApiModel();
            $statut = array("admin","premium","anonyme","simple");
            $crypto = new CryptoMonnaie();
            $tabCrypto = $crypto->getTabCrypto();
            for ($i = 0; $i < 6; $i = $i + 1) {
                $tab = $apiUser->getUserApi();
                $user = new User();
                $user->setNom($tab['name']['first']);
                $user->setPassword($tab['login']['password']);
                $user->setMail($tab['email']);
                $user->setStatut($statut[array_rand($statut,1)]);
                dump($tabCrypto[array_rand($tabCrypto,1)]);
                $user->setCryptoFav($tabCrypto[array_rand($tabCrypto,1)]);
              //  dump($user);
                $manager->persist($user);
                $manager->flush();
            }
*/
    }
}