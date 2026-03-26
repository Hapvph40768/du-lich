@extends('layouts.admin')

@section('title', 'Quản lý Tin Tức & Cẩm Nang')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Cẩm Nang Du Lịch (Blog)</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Quản lý các bài viết tin tức và kinh nghiệm du lịch</p>
    </div>
    <a href="{{ route('admin.blogs.create') }}" class="btn">+ Viết Bài Mới</a>
</div>

<div class="glass" style="border-radius: var(--radius-lg); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: rgba(0,0,0,0.03); border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Tiêu đề</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Tác giả</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Trạng thái</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main);">Ngày tạo</th>
                <th style="padding: 1rem 1.5rem; font-weight: 600; color: var(--text-main); text-align: right;">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <td style="padding: 1rem 1.5rem; font-weight: 600; color: var(--primary-color);">
                    {{ Str::limit($blog->title, 50) }}
                </td>
                <td style="padding: 1rem 1.5rem;">{{ $blog->author->name ?? 'Admin' }}</td>
                <td style="padding: 1rem 1.5rem;">
                    <span style="padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; 
                        {{ $blog->status === 'published' ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #f3f4f6; color: #4b5563;' }}">
                        {{ $blog->status === 'published' ? 'Đã xuất bản' : 'Bản nháp' }}
                    </span>
                </td>
                <td style="padding: 1rem 1.5rem;">{{ $blog->created_at->format('d/m/Y') }}</td>
                <td style="padding: 1rem 1.5rem; text-align: right; display: flex; justify-content: flex-end; gap: 0.5rem;">
                    <a href="{{ route('admin.blogs.edit', $blog) }}" style="color: var(--primary-color); text-decoration: none;">Sửa</a>
                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này?');" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:none; border:none; color: var(--danger); cursor:pointer; font-weight: 500; font-family: inherit;">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 2rem; text-align: center; color: var(--text-muted);">Chưa có bài viết nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.5rem;">
    {{ $blogs->links() }}
</div>
@endsection
