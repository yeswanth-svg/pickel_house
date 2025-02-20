<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoriesController extends Controller
{
    //
    public function index()
    {
        $categories = TicketCategory::all();

        return view('admin.support.ticket-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|string',
            ]
        );

        $cat = new TicketCategory();
        $cat->name = $request->name;
        $cat->save();

        return redirect()->route('admin.tickets-categories.index')->with('success', 'Ticket Category Added Successfully');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category = TicketCategory::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.tickets-categories.index')->with('success', 'Ticket Category Updated Successfully');
    }


    public function destroy($id)
    {
        $category = TicketCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.tickets-categories.index')->with('success', 'Ticket Category Deleted Successfully');
    }





}
