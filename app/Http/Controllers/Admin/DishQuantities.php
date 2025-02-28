<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\DishQuantity;
use Illuminate\Http\Request;

class DishQuantities extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $quantites = DishQuantity::orderBy('dish_id')->get();
        return view('admin.quantity.index', compact('quantites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $dishes = Dish::all();
        return view('admin.quantity.create', compact('dishes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'dish_id' => ['required', 'integer'],
            'weight' => ['required', 'string'],
            'original_price' => ['required'],
            'discount_price' => ['required'],
        ]);
        $quantity = new DishQuantity();
        $quantity->dish_id = $request->dish_id;
        $quantity->weight = $request->weight;
        $quantity->original_price = $request->original_price;
        $quantity->discount_price = $request->discount_price;
        $quantity->save();
        return redirect()->route('admin.quantity.index')->with('success', 'Quantity created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $quantity = DishQuantity::find($id);
        $dishes = Dish::all();
        return view('admin.quantity.edit', compact('quantity', 'dishes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'dish_id' => ['required', 'integer'],
            'weight' => ['required', 'string'],
            'original_price' => ['required'],
            'discount_price' => ['required'],
        ]);
        $quantity = DishQuantity::find($id);
        $quantity->dish_id = $request->dish_id;
        $quantity->weight = $request->weight;
        $quantity->original_price = $request->original_price;
        $quantity->discount_price = $request->discount_price;
        $quantity->save();
        return redirect()->route('admin.quantity.index')->with('success', 'Quantity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DishQuantity::find($id)->delete();
        return redirect()->route('admin.quantity.index')->with('success', 'Quantity deleted successfully');
    }
}
