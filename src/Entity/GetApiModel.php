<?php

namespace App\Entity;

use App\Repository\GetApiModelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GetApiModelRepository::class)
 */
class GetApiModel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCryptoList()
    {
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/map';
        $parameters = [
            'start' => '1',
            'limit' => '10'
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: 7db99011-d62c-4c57-a3f9-ea635b8f12d0'
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
// Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
     /*   $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/public/json/CoinMarket/apiCoinMarket.json', 'w');
        fwrite($fp, $response);
        fclose($fp);*/
        //print_r(json_decode($response)); // print json decoded response

        $tab =  json_decode($response,true);

       /* foreach ($tab['data'] as $key => $object) {
                echo $twig->render('get_api/index.html',['Nom' => "".$object['name']."\n"]);
                exit();
        }*/
        return $tab['data'];

    }

    public function getCryptoCryptoByCat($cat){
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/category';
        $parameters = [
            'start' => '1',
            'id' => "$cat"
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: 7db99011-d62c-4c57-a3f9-ea635b8f12d0'
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
// Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        /*   $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/public/json/CoinMarket/apiCoinMarket.json', 'w');
           fwrite($fp, $response);
           fclose($fp);*/
        //print_r(json_decode($response)); // print json decoded response

        $tab =  json_decode($response,true);

        /* foreach ($tab['data'] as $key => $object) {
                 echo $twig->render('get_api/index.html',['Nom' => "".$object['name']."\n"]);
                 exit();
         }*/
        var_dump($tab);
        return $tab['data'];

    }

    public function getCrypto($action)
    {
        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/$action";
        $parameters = [
            'start' => '1',
            'limit' => '10'
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: 51a83b25-8c68-413e-9c3c-4b0ebfe7efd7'
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
// Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));
        $response = curl_exec($curl); // Send the request, save the response
        $tab =  json_decode($response,true);
        return $tab['data'];
    }

    public function getUserApi(){
        $json = file_get_contents('https://randomuser.me/api/');
        $obj = json_decode($json,true);
  //      var_dump($obj);
        return $obj['results'][0];
    }

    public function getCryptoCoingecko(){
        $url = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&order=market_cap_desc&per_page=100&page=1&sparkline=false";
        $json = file_get_contents($url);
        $obj = json_decode($json,true);
        return $obj;
    }
    public function getCatCoingecko(){
        $url = "https://api.coingecko.com/api/v3/coins/categories";
        $json = file_get_contents($url);
        $obj = json_decode($json,true);
        return $obj;
    }

    public function getCatCoingeckoById($id){
        $url = "https://api.coingecko.com/api/v3/coins/$id?tickers=false&market_data=false&community_data=false&developer_data=false&sparkline=false";

        $json = file_get_contents($url);
        $obj = json_decode($json,true);

        return $obj;
    }

}
