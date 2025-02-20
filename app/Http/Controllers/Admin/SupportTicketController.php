<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tickets = Ticket::all();
        return view('admin.support.tickets.index', compact('tickets'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $ticket = Ticket::findorfail($id);
        return view('admin.support.tickets.show', compact('ticket'));

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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);

        // Delete Attachments from Public Folder and Database
        foreach ($ticket->attachments as $attachment) {
            $fileName = basename($attachment->file_path); // Extract only the file name
            $filePath = public_path("support_ticket_attachments/{$fileName}"); // Correct file path

            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }

            $attachment->delete(); // Delete the attachment record from the database
        }

        // Delete Messages Related to the Ticket
        $ticket->messages()->delete();

        // Delete Ticket
        $ticket->delete();

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket Deleted Successfully');
    }


    public function change_status(Request $request, $id)
    {

        $ticket = Ticket::find($id);
        $ticket->status = $request->status;
        $ticket->save();
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket Status Updated Successfully');
    }


}
