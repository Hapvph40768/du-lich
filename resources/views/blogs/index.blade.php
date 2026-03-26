@extends('layouts.app')

@section('title', 'Cẩm Nang Du Lịch')

@section('content')
<div style="background-color: var(--primary-color); padding: 4rem 20px; text-align: center; color: white;">
    <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem;">Cẩm Nang Du Lịch</h1>
    <p style="font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto;">Những kinh nghiệm, bí kíp và điểm đến thú vị nhất được chia sẻ từ WanderTours.</p>
</div>

<div class="container" style="max-width: 1200px; margin: 4rem auto; padding: 0 20px;">
    
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 2.5rem; margin-bottom: 3rem;">
        @forelse($blogs as $blog)
        <a href="{{ route('blogs.show', $blog->id) }}" style="text-decoration: none; color: inherit; display: block; border-radius: var(--radius-lg); overflow: hidden; background: white; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div style="height: 220px; background-color: #f3f4f6; position: relative;">
                @if($blog->image)
                <img src="{{ $blog->image }}" alt="{{ $blog->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                </div>
                @endif
                <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(255,255,255,0.9); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; color: var(--primary-color);">
                    {{ $blog->created_at->format('d/m/Y') }}
                </div>
            </div>
            
            <div style="padding: 1.5rem;">
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; line-height: 1.4;">{{ $blog->title }}</h3>
                <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                    {{ strip_tags($blog->content) }}
                </p>
                <div style="margin-top: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
                    <span style="font-weight: 500; font-size: 0.85rem; color: #4b5563;">
                        Bởi: {{ $blog->author->name ?? 'WanderTours' }}
                    </span>
                    <span style="color: var(--primary-color); font-weight: 600; font-size: 0.85rem;">Đọc thêm &rarr;</span>
                </div>
            </div>
        </a>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 0; color: var(--text-muted);">
            <h3>Hiện chưa có bài viết nào.</h3>
            <p>Vui lòng quay lại sau nhé.</p>
        </div>
        @endforelse
    </div>

    <div style="display: flex; justify-content: center;">
        {{ $blogs->links() }}
    </div>
</div>
@endsection
