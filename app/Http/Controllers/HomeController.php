<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        // Fetch categories with only 5 dishes per category
        $categories = Category::with([
            'dishes' => function ($query) {
                $query->limit(5); // Limit to 5 dishes per category
            }
        ])->get();

        return view('welcome', compact('categories'));
    }


    public function about_us()
    {
        return view('about');
    }

    public function menu(Request $request)
    {
        $categories = Category::all();

        // Get selected category OR set the first category as default
        $selectedCategory = $request->input('category', optional($categories->first())->id);

        // Filter dishes based on category
        $query = Dish::query()->where('category_id', $selectedCategory);

        // Paginate results (12 per page)
        $dishes = $query->paginate(12);

        return view('menu', compact('categories', 'dishes', 'selectedCategory'));
    }



    public function contact()
    {
        return view('contact');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function singleDish($id)
    {

        $dish = Dish::findOrFail($id);
        return view('singlepageitem', compact('dish'));
    }
}
