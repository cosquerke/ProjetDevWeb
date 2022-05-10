<?php

namespace App\DataFixtures;
use App\Entity\CryptoMonnaie;
use App\Entity\GetApiModel;
use App\Entity\Categorie;
use congig\configVar;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CryptoFixtures extends Fixture
{
    public function load(ObjectManager $manager){
    /*    $tabCryptos = new GetApiModel();
        $tabCrypto = $tabCryptos->getCrypto("map");

        foreach ($tabCrypto as $key => $object) {
            /* $crypto = new CryptoMonnaie();
             $crypto->setNom($object['name']);
             $crypto->setPrix(5);
             $crypto->setSymbole($object['symbol']);
             $crypto->setLogo("img/".$object['symbol']);
             dump($object);
            $manager->persist($crypto);
            $manager->flush();
        }*/
     /*   $tabCryptos = new GetApiModel();
        $listeCategorie = $tabCryptos->getCrypto("categories");
        foreach ($listeCategorie as $key => $object) {
            $crypto = new CryptoMonnaie();
            $tabCrypto = $tabCryptos->getCryptoCryptoByCat($object['id']);
            for ($i = 0; $i < count($tabCrypto['coins']); $i = $i + 1){
                $crypto = new CryptoMonnaie();
                $crypto->setNom($tabCrypto['coins'][$i]['name']);
                $crypto->setNom($tabCrypto['coins'][$i]['name']);
                $crypto->setPrix(5);
                $crypto->setSymbole($tabCrypto['coins'][$i]['symbol']);
                $crypto->setLogo("img/".$tabCrypto['coins'][$i]['symbol']);

                $manager->persist($crypto);
                $manager->flush();


                $categorie = new Categorie();
                $categorie->setNom($tabCrypto['name']);
                $categorie->setCommentaire($tabCrypto['description']);
                $categorie->setcryptomonnaie($crypto);

                $manager->persist($categorie);
                $manager->flush();

            }

        }*/
        /* for ($i = 0; $i < 2; $i++) {
             $crypto = new CryptoMonnaie();
             $crypto->setNom("Crypto n°$i");
             $crypto->setLogo("Chemin $i");
             $crypto->setPrix($i*$i);

             $manager->persist($crypto);
             $manager->flush();
        }*/


    }
}