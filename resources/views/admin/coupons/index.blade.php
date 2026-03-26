@extends('layouts.admin')

@section('title', 'Quản lý Mã Giảm Giá')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Mã Giảm Giá</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Quản lý các chương trình ưu đãi và mã giảm giá</p>
    </div>
    <a href="{{ route('admin.coupons.create') }}" class="btn">+ Thêm Mã Mới</a>
</div>

<div class="glass" style="border-radius: var(--radius-lg); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: rgba(0,0,0,0.03); border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Mã (Code)</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Giảm (%)</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Hiệu Lực Từ</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Đến Ngày</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Trạng Thái</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main); text-align: right;">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coupons as $coupon)
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <td style="padding: 1rem 1.5rem; font-weight: 600; color: var(--primary-color);">{{ $coupon->code }}</td>
                <td style="padding: 1rem 1.5rem; font-weight: 500;">{{ $coupon->discount_percent }}% <br><small style="color: var(--text-muted); font-weight: 400;">Tối đa: ${{ number_format($coupon->max_discount, 2) }}</small></td>
                <td style="padding: 1rem 1.5rem;">{{ \Carbon\Carbon::parse($coupon->start_date)->format('d/m/Y') }}</td>
                <td style="padding: 1rem 1.5rem;">{{ \Carbon\Carbon::parse($coupon->end_date)->format('d/m/Y') }}</td>
                <td style="padding: 1rem 1.5rem;">
                    <span style="padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; 
                        {{ $coupon->status === 'active' ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;' }}">
                        {{ $coupon->status === 'active' ? 'Đang hoạt động' : 'Hết hạn' }}
                    </span>
                </td>
                <td style="padding: 1rem 1.5rem; text-align: right; display: flex; justify-content: flex-end; gap: 0.5rem;">
                    <a href="{{ route('admin.coupons.edit', $coupon) }}" style="color: var(--primary-color); text-decoration: none;">Sửa</a>
                    <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa mã này?');" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:none; border:none; color: var(--danger); cursor:pointer; font-weight: 500; font-family: inherit;">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 2rem; text-align: center; color: var(--text-muted);">Không có mã giảm giá nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $coupons->links() }}
</div>
@endsection
