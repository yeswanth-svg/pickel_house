<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
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
        //
        $request->validate(
            [
                'key' => 'required',
                'value' => 'required',
            ]
        );

        $setting = new Setting();
        $setting->key = $request->key;
        $setting->value = $request->value;
        $setting->content = $request->content;
        $setting->save();

        return redirect()->route('admin.settings.index')->with('success', 'Setting Added Successfully');

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
    public function update(Request $request, string $id)
    {
        //
        $request->validate(
            [
                'key' => 'required',
                'value' => 'required',
            ]
        );

        $setting = Setting::findOrFail($id);
        $setting->key = $request->key;
        $setting->value = $request->value;
        $setting->content = $request->content;
        $setting->update();

        return redirect()->route('admin.settings.index')->with('success', 'Setting Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $setting = Setting::findOrFail($id);
        $setting->delete();
        return redirect()->route('admin.settings.index')->with('success', 'Setting Deleted Successfully');

    }
}
