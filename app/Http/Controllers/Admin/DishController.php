<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dishes = Dish::all();
        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.dishes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'image' => ['required', 'mimes:jpg,jpeg,png'], // Corrected this line
            'spice_level' => ['required'],
        ]);


        $dish = new Dish();
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->category_id = $request->category_id;
        $dish->spice_level = $request->spice_level;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();

            $directory = public_path('dish_images');

            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);

            }
            $image->move($directory, $name);

            $dish->image = $name;
        }

        $dish->save();

        return redirect()->route('admin.dishes.index')->with('success', 'Dish created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $dish = Dish::find($id);
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $dish = Dish::find($id);
        $categories = Category::all();
        return view('admin.dishes.edit', compact('dish', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Dish $dish)
    {
        // Validate request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'], // Image is nullable
            'spice_level' => ['required', 'string'],
            'availability_status' => ['required', 'string'],
            'dish_tag' => ['required', 'string'],
            'rating' => ['nullable', 'numeric', 'between:0,5'],
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($dish->image && File::exists(public_path('dish_images/' . $dish->image))) {
                File::delete(public_path('dish_images/' . $dish->image));
            }

            // Upload new image
            $newImage = $request->file('image');
            $imageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('dish_images'), $imageName);
            $dish->image = $imageName; // Assign new image
        }

        // 🔹 Explicitly Assign Fields
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->category_id = $request->category_id;
        $dish->spice_level = $request->spice_level;
        $dish->availability_status = $request->availability_status;
        $dish->dish_tag = $request->dish_tag;
        $dish->rating = $request->rating;

        $dish->save(); // Save the model

        return redirect()->route('admin.dishes.index')->with('success', 'Dish updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $dish = Dish::find($id);

        if ($dish->image && File::exists(public_path('dish_images/' . $dish->image))) {
            File::delete(public_path('dish_images/' . $dish->image));
        }

        $dish->delete();

        return redirect()->route('admin.dishes.index')->with('success', 'Dish deleted successfully.');
    }
}
