<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $categories = Category::with('dishes')->get();
        return view('welcome', compact('categories'));
    }

    public function about_us()
    {
        return view('about');
    }

    public function menu()
    {
        $categories = Category::with('dishes')->get();
        return view('menu', compact('categories'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }
}
