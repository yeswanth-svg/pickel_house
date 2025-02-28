<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use App\Models\DishImage;
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
        $dishes = Dish::orderBy('category_id')->get();
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'main_image' => ['required', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'], // Main Image (Required)
            'extra_images.*' => ['nullable', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'], // Multiple Images
            'spice_level' => ['required'],
        ]);

        // 🔹 Create Dish
        $dish = new Dish();
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->category_id = $request->category_id;
        $dish->spice_level = $request->spice_level;

        // 🔹 Handle Main Image Upload
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $imageName = time() . '_main.' . $mainImage->getClientOriginalExtension();

            $directory = public_path('dish_images');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $mainImage->move($directory, $imageName);
            $dish->image = $imageName; // Save main image filename
        }

        $dish->save(); // Save dish before adding multiple images

        // 🔹 Handle Multiple Extra Images Upload
        if ($request->hasFile('extra_images')) {
            foreach ($request->file('extra_images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('dish_images'), $imageName);

                DishImage::create([
                    'dish_id' => $dish->id,
                    'image_path' => $imageName
                ]);
            }
        }

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
            'main_image' => ['nullable', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'], // Main image
            'extra_images.*' => ['nullable', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'], // Multiple images
            'spice_level' => ['required', 'string'],
            'availability_status' => ['required', 'string'],
            'ingredients' => ['required', 'string'],
            'dish_tags' => ['required', 'string'],
            'rating' => ['nullable', 'numeric', 'between:0,5'],
        ]);

        // 🔹 Handle Main Image Upload
        if ($request->hasFile('main_image')) {
            // Delete old main image if it exists
            if ($dish->image && File::exists(public_path('dish_images/' . $dish->image))) {
                File::delete(public_path('dish_images/' . $dish->image));
            }

            // Upload new main image
            $mainImage = $request->file('main_image');
            $imageName = time() . '_main.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('dish_images'), $imageName);
            $dish->image = $imageName; // Assign new image
        }

        // 🔹 Handle Deletion of Old Extra Images Before Uploading New Ones
        if ($request->hasFile('extra_images')) {
            // Get all old images and delete from storage
            $oldImages = DishImage::where('dish_id', $dish->id)->get();
            foreach ($oldImages as $oldImage) {
                if (File::exists(public_path('dish_images/' . $oldImage->image_path))) {
                    File::delete(public_path('dish_images/' . $oldImage->image_path));
                }
            }

            // Delete old images from the database
            DishImage::where('dish_id', $dish->id)->delete();

            // Upload and save new extra images
            foreach ($request->file('extra_images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('dish_images'), $imageName);

                DishImage::create([
                    'dish_id' => $dish->id,
                    'image_path' => $imageName
                ]);
            }
        }

        // 🔹 Convert tags into JSON format
        $dishtags = json_encode(explode(',', $request->dish_tags));

        $ingredients = json_encode(explode(',', $request->ingredients));

        // 🔹 Update Dish Details
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->category_id = $request->category_id;
        $dish->spice_level = $request->spice_level;
        $dish->availability_status = $request->availability_status;
        $dish->dish_tags = $dishtags;
        $dish->ingredients = $ingredients;
        $dish->rating = $request->rating;
        $dish->save();

        return redirect()->route('admin.dishes.index')->with('success', 'Dish updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        // Find the Dish
        $dish = Dish::find($id);

        if (!$dish) {
            return redirect()->route('admin.dishes.index')->with('error', 'Dish not found.');
        }

        // Delete main dish image
        if ($dish->image && File::exists(public_path('dish_images/' . $dish->image))) {
            File::delete(public_path('dish_images/' . $dish->image));
        }

        // Fetch all associated images and delete them
        $dish_images = DishImage::where('dish_id', $id)->get();

        foreach ($dish_images as $dish_image) {
            if (File::exists(public_path('dish_images/' . $dish_image->image_path))) {
                File::delete(public_path('dish_images/' . $dish_image->image_path));
            }
        }

        // Delete related images from database
        DishImage::where('dish_id', $id)->delete();

        // Delete the dish
        $dish->delete();

        return redirect()->route('admin.dishes.index')->with('success', 'Dish deleted successfully.');
    }

}
