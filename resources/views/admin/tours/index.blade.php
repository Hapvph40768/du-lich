@extends('layouts.admin')

@section('title', 'Quản Lý Tour')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Danh Sách Tour</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Quản lý toàn bộ các tour du lịch trong hệ thống</p>
    </div>
    <a href="{{ route('admin.tours.create') }}" class="btn" style="width: auto; border-radius: 50px; padding: 0.6rem 1.5rem;">+ Thêm Tour Mới</a>
</div>

<div class="glass" style="border-radius: var(--radius-lg); overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: rgba(0,0,0,0.02); border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">ID</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Tên Tour / Chuyên mục</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Địa điểm</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Giá (VNĐ/$)</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Trạng thái</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main); text-align: right;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tours as $tour)
            <tr style="border-bottom: 1px solid var(--glass-border); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.01)'" onmouseout="this.style.backgroundColor='transparent'">
                <td style="padding: 1rem 1.5rem; color: var(--text-muted);">#{{ $tour->id }}</td>
                <td style="padding: 1rem 1.5rem; font-weight: 600; color: var(--primary-color);">
                    {{ Str::limit($tour->name, 40) }}<br>
                    <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 400;">{{ $tour->category->name ?? 'Chưa rỗ' }}</span>
                </td>
                <td style="padding: 1rem 1.5rem; color: var(--text-muted);">{{ $tour->location->name ?? 'Chưa rõ' }}</td>
                <td style="padding: 1rem 1.5rem; color: var(--danger); font-weight: 600;">{{ number_format($tour->price, 0) }} đ</td>
                <td style="padding: 1rem 1.5rem;">
                    <span style="padding: 0.35rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; 
                        {{ $tour->status === 'active' ? 'background-color: #d1e7dd; color: #0f5132;' : 'background-color: #f8d7da; color: #842029;' }}">
                        {{ $tour->status === 'active' ? 'Hoạt động' : 'Đã ngưng' }}
                    </span>
                </td>
                <td style="padding: 1rem 1.5rem; text-align: right;">
                    <a href="{{ route('admin.tours.edit', $tour) }}" style="color: var(--primary-color); text-decoration: none; margin-right: 1rem; font-weight: 500;">Sửa</a>
                    <form action="{{ route('admin.tours.destroy', $tour) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: var(--danger); font-weight: 500; cursor: pointer; font-family: inherit;" onclick="return confirm('Bạn có chắc muốn xóa tour này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 3rem 2rem; text-align: center; color: var(--text-muted);">
                    <div style="font-size: 1.1rem; margin-bottom: 0.5rem;">Chưa có tour nào.</div>
                    <a href="{{ route('admin.tours.create') }}" style="color: var(--primary-color); font-weight: 500;">Tạo tour đầu tiên</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $tours->links() }}
</div>
@endsection
