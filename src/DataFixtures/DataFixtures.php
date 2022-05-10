<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use App\Entity\CryptoMonnaie;
use App\Entity\GetApiModel;
use App\Entity\Categorie;
use App\Entity\User;
use App\Entity\Commentaire;

class DataFixtures extends \Doctrine\Bundle\FixturesBundle\Fixture
{

    /**
     * @inheritDoc
     */

    public const REF_CRYPTO = 'CRYPTO-REF-';
    public const REF_USER = 'USER-REF-';
    public const REF_CAT = 'CAT-REF-';


    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
/* *************************** CREATION DES Cryptos ********************************** */
/*        $tabCryptos = new GetApiModel();
        $listeCategorie = $tabCryptos->getCrypto("categories");
        $count = 0;
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
                $this->addReference(get_called_class()::REF_CRYPTO.$count,$crypto);
                $count = $count + 1;
                $manager->flush();


                $categorie = new Categorie();
                $categorie->setNom($tabCrypto['name']);
                $categorie->setCommentaire($tabCrypto['description']);
                $categorie->setcryptomonnaie($crypto);

                $manager->persist($categorie);
                $manager->flush();

            }

        }
*/



        $cryptoM = new GetApiModel();
        $tabCrypto = $cryptoM->getCryptoCoingecko();
        foreach ($tabCrypto as $key => $object){
            $crypto = new CryptoMonnaie();
            $crypto->setNom($object['name']);
            $crypto->setPrix($object['current_price']);
            $crypto->setSymbole($object['symbol']);
            $crypto->setLogo($object['image']);

            $manager->persist($crypto);
            $this->addReference(get_called_class()::REF_CRYPTO.$key,$crypto);
            $count = $key;
            dump($count);
            $manager->flush();

            $tabCategorie = $cryptoM->getCatCoingeckoById($object['id']);
            foreach ($tabCategorie as $cle => $attribut){
                $categorie = new Categorie();
                try {
                    $nom = $tabCategorie['categories'][0];
                    if($nom == null){
                        $categorie->setNom("Pas de catégorie");
                    }else{
                        $categorie->setNom($nom);
                    }
                    if ($tabCategorie['description']['en'] == null){
                        $categorie->setCommentaire("Pas de commentaire");
                    }else{
                        $categorie->setCommentaire($tabCategorie['description']['en']);
                    }
                    $categorie->setcryptomonnaie($crypto);
                    $manager->persist($categorie);
                    $manager->flush();
                }catch (\Exception $e){

                }

            }



        }
      /*  $tabCategorie = $cryptoM->getCatCoingecko();
        foreach ($tabCategorie as $key => $object){

            $categorie = new Categorie();
            $categorie->setNom($object['name']);
            if ($object['content'] != null){
                $categorie->setCommentaire($object['content']);
            }else{
                $categorie->setCommentaire("");
            }
            $manager->persist($categorie);
            $this->addReference(get_called_class()::REF_CAT.$object['name'],$categorie);
            $manager->flush();


        }*/





/* ************************ CREATION DES User ************************************* */



        $apiUser = new GetApiModel();
        $statut = array("admin","premium","anonyme","simple");
        $crypto = new CryptoMonnaie();
        $tabCrypto = $crypto->getTabCrypto();
        $nbUser = 0;
        for ($i = 0; $i < 6; $i = $i + 1) {
            $tab = $apiUser->getUserApi();
            $user = new User();
            $user->setNom($tab['name']['first']);
            $user->setPassword($tab['login']['password']);
            $user->setMail($tab['email']);
            $user->setStatut($statut[array_rand($statut,1)]);
           // dump($tabCrypto[array_rand($tabCrypto,1)]);
            $user->setCryptoFav($manager->merge($this->getReference(get_called_class()::REF_CRYPTO.rand(0,$count-1))));
            //  dump($user);
            $manager->persist($user);
            $this->addReference(get_called_class()::REF_USER.$i,$user);
            $manager->flush();
            $nbUser = $nbUser + 1;
        }
        /* ************************ CREATION DES Commentaire ************************************* */
        $texte = array("Super","Efficace","Peu fiable","A surveiller");
        for ($i = 0; $i < 3; $i = $i + 1) {
            $commmentaire = new Commentaire();
            $commmentaire->setAuteur($manager->merge($this->getReference(get_called_class()::REF_USER.rand(0,$nbUser-1))));
            $commmentaire->setTexte($texte[array_rand($texte,1)]);
            $commmentaire->setDate(new \DateTime(rand(2000,2022)."-01-01"));
            //  dump($user);
            $manager->persist($commmentaire);
            $manager->flush();
        }


    }
}