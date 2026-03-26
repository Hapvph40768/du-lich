@extends('layouts.admin')

@section('title', 'Ticket Details')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Ticket #{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Subject: {{ $ticket->subject }} &bull; Customer: {{ $ticket->user->name ?? 'Unknown' }}</p>
    </div>
    
    <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST" style="display: flex; gap: 10px; align-items: center;">
        @csrf
        @method('PUT')
        <select name="status" class="form-control" style="width: 150px; padding: 0.5rem;">
            <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
            <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
        </select>
        <button type="submit" class="btn" style="padding: 0.5rem 1rem;">Update</button>
    </form>
</div>

<div style="display: flex; gap: 2rem;">
    <div class="glass" style="flex: 2; border-radius: var(--radius-lg); padding: 2rem; display: flex; flex-direction: column; max-height: 600px;">
        <h3 style="margin-top: 0; margin-bottom: 1.5rem; font-size: 1.1rem;">Conversation History</h3>
        
        <div style="flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 1rem; padding-right: 1rem;">
            @forelse($ticket->messages as $msg)
                <div style="max-width: 80%; {{ $msg->is_admin ? 'align-self: flex-end;' : 'align-self: flex-start;' }}">
                    <div style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 0.25rem; {{ $msg->is_admin ? 'text-align: right;' : '' }}">
                        {{ $msg->is_admin ? 'Support/AI' : ($msg->user->name ?? 'Customer') }} &bull; {{ $msg->created_at->format('H:i') }}
                    </div>
                    <div style="{{ $msg->is_admin ? 'background: var(--primary-color); color: white; border-radius: 15px 15px 0 15px;' : 'background: #f3f4f6; color: #1f2937; border-radius: 15px 15px 15px 0;' }} padding: 1rem;">
                        {{ $msg->message }}
                    </div>
                </div>
            @empty
                <p style="color: var(--text-muted); text-align: center;">No messages yet.</p>
            @endforelse
        </div>
        
        <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST" style="margin-top: 1.5rem; display: flex; gap: 10px; border-top: 1px solid var(--glass-border); padding-top: 1.5rem;">
            @csrf
            <!-- We actually need a separate route for reply. Let's assume TicketController@reply doesn't exist yet so it just goes back or we don't build it if not needed. -->
            <input type="text" name="reply_msg" class="form-control" placeholder="Admin reply currently disabled..." disabled>
            <button type="button" class="btn" disabled style="opacity: 0.5;">Send</button>
        </form>
    </div>
    
    <div style="flex: 1;">
        <div class="glass" style="border-radius: var(--radius-lg); padding: 1.5rem;">
            <h3 style="margin-top: 0; font-size: 1.1rem;">Customer Info</h3>
            <p style="margin-bottom: 0.5rem;"><strong>Name:</strong> {{ $ticket->user->name ?? 'N/A' }}</p>
            <p style="margin-bottom: 0.5rem;"><strong>Email:</strong> {{ $ticket->user->email ?? 'N/A' }}</p>
            <p style="margin-bottom: 0;"><strong>Phone:</strong> {{ $ticket->user->phone ?? 'N/A' }}</p>
        </div>
    </div>
</div>
@endsection
