@extends('layouts.admin')

@section('title', 'Cập nhật Thanh Toán')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Cập nhật Thanh Toán #{{ $payment->id }}</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Đơn đặt hàng liên quan: #BK{{ $payment->booking_id }}</p>
    </div>
    <a href="{{ route('admin.payments.index') }}" class="btn" style="background: #e5e7eb; color: #374151;">Quay lại</a>
</div>

<div class="glass" style="max-width: 800px; padding: 2rem; border-radius: var(--radius-lg);">
    
    <div style="margin-bottom: 2rem; padding: 1.5rem; background: rgba(0,0,0,0.02); border-radius: 10px; border: 1px solid var(--glass-border);">
        <h3 style="margin-bottom: 1rem; font-size: 1.1rem;">Thông tin giao dịch</h3>
        <p><strong>Khách hàng:</strong> {{ $payment->booking->user->name }} ({{ $payment->booking->user->email }})</p>
        <p><strong>Số tiền:</strong> ${{ number_format($payment->amount, 2) }}</p>
        <p><strong>Phương thức:</strong> {{ strtoupper($payment->payment_method) }}</p>
        <p><strong>Ngày tạo:</strong> {{ $payment->created_at->format('d/m/Y H:i:s') }}</p>
    </div>

    <form action="{{ route('admin.payments.update', $payment) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Trạng thái giao dịch</label>
            <select name="status" class="form-control" required {{ $payment->status === 'success' ? 'disabled' : '' }}>
                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Đang chờ / Chưa thanh toán</option>
                <option value="success" {{ $payment->status == 'success' ? 'selected' : '' }}>Thành công (Đã nhận tiền)</option>
                <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Thất bại / Bị hủy</option>
                <option value="refunded" {{ $payment->status == 'refunded' ? 'selected' : '' }}>Đã hoàn tiền</option>
            </select>
            @error('status')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
            @if($payment->status === 'success')
                <input type="hidden" name="status" value="success">
                <small style="color: var(--text-muted); display: block; margin-top: 0.5rem;">Giao dịch đã thành công không thể thay đổi trạng thái khác trừ hoàn tiền (vui lòng liên hệ dev nếu cần thiết).</small>
            @endif
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Mã giao dịch (Nội bộ / Gateway)</label>
            <input type="text" name="transaction_id" class="form-control" value="{{ old('transaction_id', $payment->transaction_id) }}" placeholder="Nhập mã VNPay / Transfer bill rrn nếu có">
            @error('transaction_id')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn" {{ $payment->status === 'success' && empty(old('transaction_id')) && empty($payment->transaction_id) ? '' : ($payment->status === 'success' ? 'disabled' : '') }}>Cập nhật Giao Dịch</button>
    </form>
</div>
@endsection
