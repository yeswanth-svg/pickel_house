<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketCategory;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserSupportTicketsController extends Controller
{
    //

    public function index()
    {
        $user_id = auth()->user()->id;
        $tickets = Ticket::where('user_id', $user_id)->get();
        return view('user.support-tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = TicketCategory::all();
        return view('user.support-tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'subject' => 'required|string|max:255',
            'category_id' => 'required|exists:ticket_categories,id',
            'priority' => 'required|in:low,medium,high,urgent',
            'description' => 'required|string',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ticket = new Ticket();
        $ticket->user_id = auth()->id();
        $ticket->subject = $request->subject;
        $ticket->category_id = $request->category_id; // Ensure it's assigned
        $ticket->priority = $request->priority;
        $ticket->description = $request->description;
        $ticket->status = 'open';
        $ticket->save();

        // Handle attachments if uploaded
        if ($request->hasFile('attachments')) {
            $uploadPath = public_path('support_ticket_attachments');

            // Check if directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }

            foreach ($request->file('attachments') as $file) {
                // Generate a unique filename
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Move file to public/support_ticket_attachments
                $file->move($uploadPath, $filename);

                // Save file path in the database
                TicketAttachment::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => auth()->id(),
                    'file_path' => 'support_ticket_attachments/' . $filename,
                ]);
            }
        }

        return redirect()->route('support-tickets.index')->with('success', 'Ticket submitted successfully!');
    }

    public function show($id)
    {
        $ticket = Ticket::findorfail($id);
        return view('user.support-tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::with('attachments')->findOrFail($id);
        $categories = TicketCategory::all();

        return view('user.support-tickets.edit', compact('ticket', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'category_id' => 'required|exists:ticket_categories,id',
            'priority' => 'required|in:low,medium,high,urgent',
            'description' => 'required|string',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ticket = Ticket::findorfail($id);


        // Update ticket details
        $ticket->update([
            'subject' => $request->subject,
            'category_id' => $request->category_id,
            'priority' => $request->priority,
            'description' => $request->description,
        ]);

        // Check if new attachments are uploaded
        if ($request->hasFile('attachments')) {
            $uploadPath = public_path('support_ticket_attachments');

            // Ensure directory exists
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }

            // Fetch and delete old attachments
            $oldAttachments = TicketAttachment::where('ticket_id', $ticket->id)->get();
            foreach ($oldAttachments as $attachment) {
                $oldFilePath = public_path($attachment->file_path);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $attachment->delete(); // Remove old record from the database
            }

            // Save new attachments
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $filename);

                TicketAttachment::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => auth()->id(),
                    'file_path' => 'support_ticket_attachments/' . $filename,
                ]);
            }
        }

        return redirect()->route('support-tickets.index')->with('success', 'Ticket updated successfully!');
    }





    public function sendMessage(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required',
        ]);

        // Ensure user is the owner of the ticket or an admin
        if (auth()->user()->id !== $ticket->user_id && auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        \Log::info('Message Data:', [$request->message]);

        // Save message
        $message = TicketMessage::create([
            'ticket_id' => $ticket->id,
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');

    }


}
