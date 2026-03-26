@extends('layouts.admin')

@section('title', 'Sửa Mã Giảm Giá')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Sửa Mã Giảm Giá: {{ $coupon->code }}</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Cập nhật chi tiết mã giảm giá</p>
    </div>
    <a href="{{ route('admin.coupons.index') }}" class="btn" style="background: #e5e7eb; color: #374151;">Quay lại</a>
</div>

<div class="glass" style="max-width: 800px; padding: 2rem; border-radius: var(--radius-lg);">
    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Mã Code (VD: SUMMER20)</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required style="text-transform: uppercase;">
            @error('code')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Phần Trăm Giảm (%)</label>
                <input type="number" name="discount_percent" class="form-control" value="{{ old('discount_percent', $coupon->discount_percent) }}" min="1" max="100" required>
                @error('discount_percent')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Giảm Tối Đa ($)</label>
                <input type="number" name="max_discount" class="form-control" value="{{ old('max_discount', $coupon->max_discount) }}" step="0.01" min="0">
                @error('max_discount')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Hiệu Lực Từ Ngày</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date', \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d')) }}" required>
                @error('start_date')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
            </div>
            <div>
                <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Đến Ngày</label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date', \Carbon\Carbon::parse($coupon->end_date)->format('Y-m-d')) }}" required>
                @error('end_date')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
            </div>
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Trạng Thái</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ old('status', $coupon->status) == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                <option value="expired" {{ old('status', $coupon->status) == 'expired' ? 'selected' : '' }}>Hết hạn</option>
            </select>
            @error('status')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn">Lưu Tùy Chỉnh</button>
    </form>
</div>
@endsection
