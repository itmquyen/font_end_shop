<?php

namespace App\Http\Controllers;

use App\Helpers\ExternalApi\HttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Routes
     *
     * @return void
     */
    public static function routes()
    {
        Route::get('/', [HomeController::class, 'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = HttpClient::get('http://dev.shop/api/layout/slide',[]);
        return view('home', ['slides' => $slides]);
    }
}