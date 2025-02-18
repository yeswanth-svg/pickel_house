<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingZone;
use Illuminate\Http\Request;

class ShippingZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zones = ShippingZone::orderBy('country')->get();
        return view('admin.shipping_zones.index', compact('zones'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.shipping_zones.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'country' => 'required|string|',
            'min_weight' => 'required|numeric|min:0',
            'max_weight' => 'required|numeric|min:0|gt:min_weight', // Ensure max_weight is greater than min_weight
            'standard_rate' => 'required|numeric|min:0',
            'priority_rate' => 'required|numeric|min:0',
            'currency' => 'required|string|',
        ]);

        // Create a new ShippingZone record
        ShippingZone::create([
            'country' => $request->input('country'),
            'min_weight' => $request->input('min_weight'),
            'max_weight' => $request->input('max_weight'),
            'standard_rate' => $request->input('standard_rate'),
            'priority_rate' => $request->input('priority_rate'),
            'currency' => $request->input('currency'),
        ]);

        // Redirect with success message
        return redirect()->route('admin.shipping_zones.index')->with('success', 'Shipping zone created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $zone = ShippingZone::findOrFail($id);
        return view('admin.shipping_zones.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $zone = ShippingZone::findOrFail($id);
        return view('admin.shipping_zones.edit', compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the ShippingZone by ID
        $shippingZone = ShippingZone::findOrFail($id);

        // Validate the incoming request
        $request->validate([
            'country' => 'required|string',
            'min_weight' => 'required|numeric|min:0',
            'max_weight' => 'required|numeric|min:0|gt:min_weight', // Ensure max_weight is greater than min_weight
            'standard_rate' => 'required|numeric|min:0',
            'priority_rate' => 'required|numeric|min:0',
            'currency' => 'required|string|',
        ]);

        // Update the ShippingZone record
        $shippingZone->update([
            'country' => $request->input('country'),
            'min_weight' => $request->input('min_weight'),
            'max_weight' => $request->input('max_weight'),
            'standard_rate' => $request->input('standard_rate'),
            'priority_rate' => $request->input('priority_rate'),
            'currency' => $request->input('currency'),
        ]);

        // Redirect with success message
        return redirect()->route('admin.shipping_zones.index')->with('success', 'Shipping zone updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $zone = ShippingZone::findOrFail($id);
        $zone->delete();
        return redirect()->route('admin.shipping_zones.index')->with('success', 'Shipping zone deleted successfully.');
    }
}
