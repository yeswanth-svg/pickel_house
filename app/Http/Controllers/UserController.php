<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function addAddress(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:50',
            'address_line_1' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|numeric',
        ]);

        $user_id = auth()->user()->id;

        UserAddress::create([
            'user_id' => $user_id,
            'label' => $request->input('label'),
            'address_line_1' => $request->input('address_line_1'),
            'address_line_2' => $request->input('address_line_2'),
            'city' => $request->input('city'),
            'pincode' => $request->input('pincode'),
            'is_default' => true,
        ]);

        return back()->with('success', 'Address added successfully!');
    }

    public function editAddress(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:user_addresses,id',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string',
            'pincode' => 'required|numeric',
        ]);

        $user_id = auth()->user()->id;

        UserAddress::where('id', $request->address_id)
            ->where('user_id', $user_id)
            ->update([
                'address_line_1' => $request->input('address_line_1'),
                'address_line_2' => $request->input('address_line_2'),
                'city' => $request->input('city'),
                'pincode' => $request->input('pincode'),
            ]);

        return back()->with('success', 'Address updated successfully!');
    }


}
