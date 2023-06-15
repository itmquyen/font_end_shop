<?php

namespace App\Helpers;

use App\Helpers\ExternalApi\HttpClient;

class Menu
{
    public function __construct(){

    }
   public static function getCategoryOfProduct(){
        $response = HttpClient::get('http://dev.shop/api/categorys',[]);
        $categorys = $response;

    }
}