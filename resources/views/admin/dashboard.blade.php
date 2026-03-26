@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="admin-header">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Dashboard</h1>
    <p style="color: var(--text-muted); font-size: 0.875rem;">Welcome back, {{ Auth::user()->name }}!</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
    <!-- Stats Card 1 -->
    <div class="glass" style="padding: 1.5rem; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: space-between;">
        <div>
            <span style="color: var(--text-muted); font-size: 0.875rem; font-weight: 500;">Total Tours</span>
            <h3 style="font-size: 1.875rem; font-weight: 700; color: var(--text-main); margin: 0.25rem 0 0;">0</h3>
        </div>
        <div style="width: 48px; height: 48px; border-radius: var(--radius-full); background: rgba(79, 70, 229, 0.1); display: flex; align-items: center; justify-content: center; color: var(--primary-color);">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m11 21-8-8 8-8"/><path d="m21 21-8-8 8-8"/></svg>
        </div>
    </div>

    <!-- Stats Card 2 -->
    <div class="glass" style="padding: 1.5rem; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: space-between;">
        <div>
            <span style="color: var(--text-muted); font-size: 0.875rem; font-weight: 500;">Total Bookings</span>
            <h3 style="font-size: 1.875rem; font-weight: 700; color: var(--text-main); margin: 0.25rem 0 0;">0</h3>
        </div>
        <div style="width: 48px; height: 48px; border-radius: var(--radius-full); background: rgba(16, 185, 129, 0.1); display: flex; align-items: center; justify-content: center; color: var(--success);">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
    </div>

    <!-- Stats Card 3 -->
    <div class="glass" style="padding: 1.5rem; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: space-between;">
        <div>
            <span style="color: var(--text-muted); font-size: 0.875rem; font-weight: 500;">Support Tickets</span>
            <h3 style="font-size: 1.875rem; font-weight: 700; color: var(--text-main); margin: 0.25rem 0 0;">0</h3>
        </div>
        <div style="width: 48px; height: 48px; border-radius: var(--radius-full); background: rgba(239, 68, 68, 0.1); display: flex; align-items: center; justify-content: center; color: var(--danger);">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/></svg>
        </div>
    </div>
</div>
@endsection
