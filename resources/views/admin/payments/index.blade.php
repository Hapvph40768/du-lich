@extends('layouts.admin')

@section('title', 'Quản lý Thanh Toán')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Quản Lý Thanh Toán</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Theo dõi và cập nhật trạng thái giao dịch của khách hàng</p>
    </div>
</div>

<div class="glass" style="border-radius: var(--radius-lg); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: rgba(0,0,0,0.03); border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Mã Đơn Đặt</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Khách Hàng</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Số Tiền</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Phương Thức</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Trạng Thái Thanh Toán</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Thời Gian</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main); text-align: right;">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <td style="padding: 1rem 1.5rem; font-weight: 600; color: var(--primary-color);">#BK{{ $payment->booking_id }}</td>
                <td style="padding: 1rem 1.5rem;">
                    {{ $payment->booking->user->name ?? 'N/A' }} 
                    <br><small style="color: var(--text-muted);">{{ $payment->booking->user->email ?? '' }}</small>
                </td>
                <td style="padding: 1rem 1.5rem; font-weight: 600;">${{ number_format($payment->amount, 2) }}</td>
                <td style="padding: 1rem 1.5rem;">
                    @if($payment->payment_method === 'cash') Tiền mặt
                    @elseif($payment->payment_method === 'bank_transfer') Chuyển khoản
                    @elseif($payment->payment_method === 'vnpay') VNPay
                    @elseif($payment->payment_method === 'momo') Momo
                    @endif
                </td>
                <td style="padding: 1rem 1.5rem;">
                    @php
                        $statusColors = [
                            'pending' => 'background-color: #fef3c7; color: #b45309;',
                            'success' => 'background-color: #d1fae5; color: #065f46;',
                            'failed' => 'background-color: #fee2e2; color: #991b1b;',
                            'refunded' => 'background-color: #e5e7eb; color: #374151;'
                        ];
                        $statusLabels = [
                            'pending' => 'Đang chờ',
                            'success' => 'Thành công',
                            'failed' => 'Thất bại',
                            'refunded' => 'Đã hoàn tiền'
                        ];
                    @endphp
                    <span style="padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; {{ $statusColors[$payment->status] ?? '' }}">
                        {{ $statusLabels[$payment->status] ?? $payment->status }}
                    </span>
                </td>
                <td style="padding: 1rem 1.5rem; font-size: 0.85rem;">
                    {{ $payment->created_at->format('d/m/Y H:i') }}
                </td>
                <td style="padding: 1rem 1.5rem; text-align: right;">
                    <a href="{{ route('admin.payments.edit', $payment) }}" style="color: var(--primary-color); text-decoration: none; font-weight: 500;">Cập nhật</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding: 2rem; text-align: center; color: var(--text-muted);">Không có giao dịch thanh toán nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $payments->links() }}
</div>
@endsection
