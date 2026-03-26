@extends('layouts.admin')

@section('title', 'Quản Lý Đặt Tour')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Đơn Đặt Hành Trình</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Theo dõi và quản lý các đơn đặt tour của khách hàng</p>
    </div>
</div>

<div class="glass" style="border-radius: var(--radius-lg); overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: rgba(0,0,0,0.02); border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Mã Đơn</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Khách hàng</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Tour</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Tổng Tiền</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Thanh Toán</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr style="border-bottom: 1px solid var(--glass-border); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.01)'" onmouseout="this.style.backgroundColor='transparent'">
                <td style="padding: 1rem 1.5rem; font-weight: 600; color: var(--primary-color);">#BKG-{{ $booking->id }}</td>
                <td style="padding: 1rem 1.5rem;">
                    <div style="font-weight: 600; color: var(--text-main);">{{ $booking->user->name ?? 'Đã xóa' }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $booking->user->email ?? '' }}</div>
                </td>
                <td style="padding: 1rem 1.5rem; color: var(--text-main);">
                    {{ Str::limit($booking->schedule->tour->name ?? 'Tour không còn tồn tại', 40) }}
                </td>
                <td style="padding: 1rem 1.5rem; color: var(--danger); font-weight: 600;">{{ number_format($booking->total_price, 0) }} đ</td>
                <td style="padding: 1rem 1.5rem;">
                    @php
                        $paymentStatus = $booking->payment->status ?? 'pending';
                        $paymentMethod = $booking->payment->payment_method ?? 'cash';
                        $bg = $paymentStatus === 'completed' ? '#d1fae5' : '#fef3c7';
                        $color = $paymentStatus === 'completed' ? '#065f46' : '#92400e';
                    @endphp
                    <span style="padding: 0.25rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; background-color: {{ $bg }}; color: {{ $color }}; text-transform: uppercase;">
                        {{ $paymentMethod }} - {{ $paymentStatus === 'completed' ? 'Đã thu' : 'Chưa thu' }}
                    </span>
                </td>
                <td style="padding: 1rem 1.5rem;">
                    <span style="padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; 
                        {{ $booking->status === 'confirmed' ? 'background-color: #d1e7dd; color: #0f5132;' : ($booking->status === 'cancelled' ? 'background-color: #f8d7da; color: #842029;' : 'background-color: #e2e8f0; color: #334155;') }}">
                        {{ $booking->status === 'confirmed' ? 'Xác nhận' : ($booking->status === 'cancelled' ? 'Hủy bỏ' : 'Chờ xử lý') }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 3rem; text-align: center; color: var(--text-muted);">
                    <div style="font-size: 1.1rem; margin-bottom: 0.5rem;">Chưa có đơn đặt tour nào.</div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $bookings->links() }}
</div>
@endsection
