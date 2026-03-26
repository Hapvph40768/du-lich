<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::with('user')->latest()->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = SupportTicket::with(['user', 'messages.user'])->findOrFail($id);
        return view('admin.tickets.show', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:open,closed'
        ]);

        $ticket->update(['status' => $validated['status']]);
        return back()->with('success', 'Ticket status updated.');
    }

    public function reply(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);

        $validated = $request->validate([
            'message' => 'required|string'
        ]);

        SupportMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $validated['message'],
            'is_admin' => true
        ]);

        return back()->with('success', 'Reply sent successfully.');
    }
}
