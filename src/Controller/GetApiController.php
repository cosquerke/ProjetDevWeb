<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\GetApiModel;

class GetApiController extends AbstractController
{
    /**
     * @Route("/get/api", name="app_get_api")
     */
    public function index(): Response
    {
        $apiCoinMarket = new GetApiModel();
        $apiCoinMarket->getCrypto();
        return $this->render('get_api/index.html', [
            'controller_name' => 'GetApiController',
        ]);




    }
}
