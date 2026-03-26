@extends('layouts.admin')

@section('title', 'Sửa Địa Điểm')

@section('content')
<div class="admin-header" style="margin-bottom: 2rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">Sửa Địa Điểm</h1>
    <p style="color: var(--text-muted); font-size: 0.875rem;"><a href="{{ route('admin.locations.index') }}" style="color: var(--primary-color); text-decoration: none;">Địa điểm</a> / {{ $location->name }} / Sửa</p>
</div>

<div class="glass" style="border-radius: var(--radius-lg); padding: 2.5rem; max-width: 600px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
    <form action="{{ route('admin.locations.update', $location) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" for="name" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">Tên Địa Điểm</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $location->name) }}" required style="padding: 0.8rem; border-radius: 8px;">
            @error('name')
                <span class="text-danger" style="margin-top: 0.5rem;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom: 2rem;">
            <label class="form-label" for="description" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">Mô Tả Sinh Động</label>
            <textarea id="description" name="description" class="form-control" rows="5" style="padding: 0.8rem; border-radius: 8px; resize: vertical;">{{ old('description', $location->description) }}</textarea>
            @error('description')
                <span class="text-danger" style="margin-top: 0.5rem;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn" style="padding: 0.8rem 2.5rem; border-radius: 50px; font-weight: 700; font-size: 1.05rem; box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.39);">Cập Nhật Địa Điểm</button>
    </form>
</div>
@endsection
