<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rewards = Reward::orderBy('min_cart_value')->get();
        return view('admin.rewards.index', compact('rewards'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'min_cart_value' => 'required|numeric',
            'reward_name' => 'required|string',
            'reward_message' => 'required|string',
        ]);

        Reward::create($request->all());
        return redirect()->route('admin.rewards.index')->with('success', 'Reward added successfully!');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reward $reward)
    {
        $request->validate([
            'min_cart_value' => 'required|numeric',
            'reward_name' => 'required|string',
            'reward_message' => 'required|string',
        ]);

        $reward->update($request->all());
        return redirect()->route('admin.rewards.index')->with('success', 'Reward updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Reward $reward)
    {
        $reward->delete();
        return redirect()->route('admin.rewards.index')->with('success', 'Reward deleted successfully!');
    }
}
