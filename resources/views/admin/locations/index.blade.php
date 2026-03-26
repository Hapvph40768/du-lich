@extends('layouts.admin')

@section('title', 'Quản Lý Địa Điểm')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Địa Điểm</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Quản lý các địa điểm tổ chức tour du lịch</p>
    </div>
    <a href="{{ route('admin.locations.create') }}" class="btn" style="width: auto; border-radius: 50px; padding: 0.6rem 1.5rem;">+ Thêm Địa Điểm</a>
</div>

<div class="glass" style="border-radius: var(--radius-lg); overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: rgba(0,0,0,0.02); border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">ID</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Tên</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Mô tả</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main); text-align: right;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($locations as $location)
            <tr style="border-bottom: 1px solid var(--glass-border); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.01)'" onmouseout="this.style.backgroundColor='transparent'">
                <td style="padding: 1rem 1.5rem; color: var(--text-muted);">#{{ $location->id }}</td>
                <td style="padding: 1rem 1.5rem; font-weight: 600; color: var(--primary-color);">{{ $location->name }}</td>
                <td style="padding: 1rem 1.5rem; color: var(--text-muted);">{{ Str::limit($location->description, 50) }}</td>
                <td style="padding: 1rem 1.5rem; text-align: right;">
                    <a href="{{ route('admin.locations.edit', $location) }}" style="color: var(--primary-color); text-decoration: none; margin-right: 1.5rem; font-weight: 600;">Sửa</a>
                    <form action="{{ route('admin.locations.destroy', $location) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: var(--danger); font-weight: 600; cursor: pointer; font-family: inherit;" onclick="return confirm('Bạn có chắc chắn muốn xóa địa điểm này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 3rem; text-align: center; color: var(--text-muted);">
                    <div style="font-size: 1.1rem; margin-bottom: 0.5rem;">Chưa có địa điểm nào.</div>
                    <a href="{{ route('admin.locations.create') }}" style="color: var(--primary-color); font-weight: 500;">Tạo địa điểm đầu tiên</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $locations->links() }}
</div>
@endsection
