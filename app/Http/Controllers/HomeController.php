<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
//    public function Test()
//    {
//        $cmd = "C:\\xampp\\htdocs\\FileReader\\imagick\\magick.exe " .
//            " C:\\xampp\\htdocs\\FileReader\\storage\\app\\public\\photos\\1A.tif " .
//            " C:\\xampp\\htdocs\\FileReader\\storage\\app\\public\\photos\\1A.jpg ";
//
//        exec($cmd);
//
//        return \Image::make("C:\\xampp\\htdocs\\FileReader\\storage\\app\\public\\photos\\1A.jpg")
//            ->response();
//    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
