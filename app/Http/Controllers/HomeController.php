<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        return view('welcome');
    }

    public function about_us()
    {
        return view('about');
    }

    public function menu()
    {
        return view('menu');
    }

    public function contact()
    {
        return view('contact');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
