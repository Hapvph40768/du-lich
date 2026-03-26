@extends('layouts.admin')

@section('title', 'Quản Lý Danh Mục')

@section('content')
<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Danh Mục Tour</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Phân loại và tổ chức các nhóm tour</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn" style="width: auto; border-radius: 50px; padding: 0.6rem 1.5rem;">+ Thêm Danh Mục</a>
</div>

<div class="glass" style="border-radius: var(--radius-lg); overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: rgba(0,0,0,0.02); border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">ID</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Tên danh mục</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Mô tả chi tiết</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main); text-align: right;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr style="border-bottom: 1px solid var(--glass-border); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(0,0,0,0.01)'" onmouseout="this.style.backgroundColor='transparent'">
                <td style="padding: 1rem 1.5rem; color: var(--text-muted);">#{{ $category->id }}</td>
                <td style="padding: 1rem 1.5rem; font-weight: 600; color: var(--primary-color);">{{ $category->name }}</td>
                <td style="padding: 1rem 1.5rem; color: var(--text-muted);">{{ Str::limit($category->description, 50) }}</td>
                <td style="padding: 1rem 1.5rem; text-align: right;">
                    <a href="{{ route('admin.categories.edit', $category) }}" style="color: var(--primary-color); text-decoration: none; margin-right: 1.5rem; font-weight: 600;">Sửa</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: var(--danger); font-weight: 600; cursor: pointer; font-family: inherit;" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 3rem; text-align: center; color: var(--text-muted);">
                    <div style="font-size: 1.1rem; margin-bottom: 0.5rem;">Chưa có danh mục nào.</div>
                    <a href="{{ route('admin.categories.create') }}" style="color: var(--primary-color); font-weight: 500;">Tạo danh mục đầu tiên</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $categories->links() }}
</div>
@endsection
