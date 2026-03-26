@extends('layouts.admin')

@section('title', 'Sửa Bài Viết')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Sửa Bài Viết</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Cập nhật lại nội dung, hình ảnh hoặc trạng thái bài viết</p>
    </div>
    <a href="{{ route('admin.blogs.index') }}" class="btn" style="background: #e5e7eb; color: #374151;">Quay lại</a>
</div>

<div class="glass" style="padding: 2rem; border-radius: var(--radius-lg);">
    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Tiêu đề bài viết</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
            @error('title')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">URL Ảnh Đại Diện (Tùy chọn)</label>
            <input type="url" name="image" class="form-control" value="{{ old('image', $blog->image) }}" placeholder="https://example.com/image.jpg">
            @if($blog->image)
            <div style="margin-top: 1rem;">
                <img src="{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 150px; border-radius: 8px;">
            </div>
            @endif
            @error('image')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nội dụng chi tiết</label>
            <textarea name="content" class="form-control" rows="15" required style="resize: vertical;">{{ old('content', $blog->content) }}</textarea>
            @error('content')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Trạng Thái Xuất Bản</label>
            <select name="status" class="form-control" required style="max-width: 300px;">
                <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Công khai (Published)</option>
                <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Bản nháp (Draft)</option>
            </select>
            @error('status')<div style="color: var(--danger); font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn">Lưu Tùy Chỉnh</button>
    </form>
</div>
@endsection
