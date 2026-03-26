@extends('layouts.admin')

@section('title', 'Đăng Bài Viết Mới')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Viết Bài Mới</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Thêm nội dung cẩm nang du lịch cho SEO</p>
    </div>
    <a href="{{ route('admin.blogs.index') }}" class="btn" style="background: #e5e7eb; color: #374151;">Quay lại</a>
</div>

<div class="glass" style="padding: 2rem; border-radius: var(--radius-lg);">
    <form action="{{ route('admin.blogs.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Tiêu đề bài viết</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">URL Ảnh Đại Diện (Tùy chọn)</label>
            <input type="url" name="image" class="form-control" value="{{ old('image') }}" placeholder="https://example.com/image.jpg">
            @error('image')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nội dụng chi tiết</label>
            <textarea name="content" class="form-control" rows="15" required style="resize: vertical;">{{ old('content') }}</textarea>
            @error('content')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Trạng Thái Xuất Bản</label>
            <select name="status" class="form-control" required style="max-width: 300px;">
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Công khai (Published)</option>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Bản nháp (Draft)</option>
            </select>
            @error('status')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn">Đăng Bài Viết</button>
    </form>
</div>
@endsection
