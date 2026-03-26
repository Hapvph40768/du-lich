<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function init(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated']);
        }

        $validated = $request->validate([
            'subject' => 'required|string|max:255'
        ]);

        $ticket = SupportTicket::create([
            'user_id' => Auth::id(),
            'subject' => $validated['subject'],
            'status' => 'open'
        ]);

        return response()->json([
            'success' => true, 
            'ticket_id' => $ticket->id,
            'message' => 'Great. I have opened a ticket for "' . $validated['subject'] . '". Please describe your issue in detail.'
        ]);
    }

    public function send(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false]);
        }

        $validated = $request->validate([
            'ticket_id' => 'required|exists:support_tickets,id',
            'message' => 'required|string'
        ]);

        // Save user message
        SupportMessage::create([
            'ticket_id' => $validated['ticket_id'],
            'user_id' => Auth::id(),
            'message' => $validated['message'],
            'is_admin' => false
        ]);

        // Simple mock AI response
        $reply = "Thank you for the information. Our team will review your ticket and get back to you shortly.";
        
        SupportMessage::create([
            'ticket_id' => $validated['ticket_id'],
            'user_id' => 1, // fallback admin id
            'message' => $reply,
            'is_admin' => true
        ]);

        return response()->json([
            'success' => true,
            'reply' => $reply
        ]);
    }
}
