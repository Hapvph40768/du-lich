@extends('layouts.admin')

@section('title', 'Support Tickets')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Support Tickets</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Manage customer inquiries and AI chatbot conversations</p>
    </div>
</div>

<div class="glass" style="border-radius: var(--radius-lg); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: rgba(0,0,0,0.03); border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Ticket ID</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Subject</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Customer</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Status</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Date</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main); text-align: right;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <td style="padding: 1rem 1.5rem; color: var(--text-muted);">#{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td style="padding: 1rem 1.5rem; font-weight: 500;">{{ $ticket->subject }}</td>
                <td style="padding: 1rem 1.5rem;">{{ $ticket->user->name ?? 'Unknown' }}</td>
                <td style="padding: 1rem 1.5rem;">
                    <span style="padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; 
                        {{ $ticket->status === 'open' ? 'background-color: #fef3c7; color: #92400e;' : 'background-color: #e5e7eb; color: #4b5563;' }}">
                        {{ ucfirst($ticket->status) }}
                    </span>
                </td>
                <td style="padding: 1rem 1.5rem; color: var(--text-muted); font-size: 0.9rem;">{{ $ticket->created_at->format('M d, Y') }}</td>
                <td style="padding: 1rem 1.5rem; text-align: right;">
                    <a href="{{ route('admin.tickets.show', $ticket) }}" style="color: var(--primary-color); text-decoration: none; font-weight: 500;">View Chat</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 2rem; text-align: center; color: var(--text-muted);">No support tickets found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $tickets->links() }}
</div>
@endsection
