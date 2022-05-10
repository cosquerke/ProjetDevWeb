<?php

namespace config;

class configVar
{
    public static $urlApiCoinMarket = 'https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
    public static $keyApiCoinMarket = 'X-CMC_PRO_API_KEY: 7db99011-d62c-4c57-a3f9-ea635b8f12d0';

    public static function cxBdd(){
        $retour = false;
        $host = 'localhost';
        $dbname = 'CryptoWebsite';
        $username = 'test';
        $password = 'test';

        $dsn = "mysql:host=$host;dbname=$dbname;user=$username;password=$password";

        try{
            $conn = new \PDO($dsn);

            if($conn){
                //     echo "Connecté à $dbname avec succès!";
                $retour = $conn;
            }
        }catch (\PDOException $e){
            echo $e->getMessage();
        }
        return $retour;
    }
}