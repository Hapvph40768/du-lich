@extends('layouts.admin')

@section('title', 'Thêm Tour Mới')

@section('content')
<div class="admin-header" style="margin-bottom: 2rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Thêm Tour Mới</h1>
    <p style="color: var(--text-muted); font-size: 0.875rem;"><a href="{{ route('admin.tours.index') }}" style="color: var(--primary-color); text-decoration: none;">Danh sách Tour</a> / Thêm Mới</p>
</div>

<div class="glass" style="border-radius: var(--radius-lg); padding: 2rem;">
    <form action="{{ route('admin.tours.store') }}" method="POST">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label" for="name">Tên Tour</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="price">Giá Tour</label>
                <input type="number" step="0.01" id="price" name="price" class="form-control" value="{{ old('price') }}" required>
                @error('price')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="category_id">Danh mục</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Chọn danh mục...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="location_id">Địa điểm</label>
                <select id="location_id" name="location_id" class="form-control" required>
                    <option value="">Chọn địa điểm...</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                    @endforeach
                </select>
                @error('location_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="duration_days">Số ngày</label>
                <input type="number" id="duration_days" name="duration_days" class="form-control" value="{{ old('duration_days') }}">
                @error('duration_days')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="duration_nights">Số đêm</label>
                <input type="number" id="duration_nights" name="duration_nights" class="form-control" value="{{ old('duration_nights') }}">
                @error('duration_nights')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="max_people">Số người tối đa</label>
                <input type="number" id="max_people" name="max_people" class="form-control" value="{{ old('max_people') }}">
                @error('max_people')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="status">Trạng thái</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
                </select>
                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="image_urls">Danh sách Hình ảnh (Mỗi link một dòng)</label>
                <textarea id="image_urls" name="image_urls" class="form-control" rows="3" placeholder="https://example.com/image1.jpg&#10;https://example.com/image2.jpg">{{ old('image_urls') }}</textarea>
                <span style="font-size: 0.8rem; color: var(--text-muted); margin-top: 5px; display: block;">Nhập URL hình ảnh trực tiếp. Các hình ảnh này sẽ được hiển thị trên trang chi tiết Tour.</span>
                @error('image_urls')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 1.5rem;">
            <label class="form-label" for="description">Mô tả chi tiết</label>
            <textarea id="description" name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <button type="submit" class="btn" style="width: auto; margin-top: 1rem; padding: 0.75rem 2rem; border-radius: 50px;">Lưu Tour</button>
    </form>
</div>
@endsection
