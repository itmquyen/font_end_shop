<?php

namespace App\Helpers;

use App\Helpers\ExternalApi\HttpClient;

class Menu
{
    private  $client;
    public function __construct(){
        $this->client = new HttpClient();
    }
   public static function getCategoryOfProduct(){
        $response = self::$client->get('http://dev.shop/api/categorys',[]);
        $categorys = json_decode($response->getBody()->getContents(),true);

    }
}
