@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div style="max-width: 800px; margin: 4rem auto; padding: 0 20px;">
    
    <a href="{{ route('blogs.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: var(--text-muted); margin-bottom: 2rem; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='var(--primary-color)'" onmouseout="this.style.color='var(--text-muted)'">
        &larr; Trở về danh sách Cẩm nang
    </a>

    <h1 style="font-size: 2.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 1.5rem; color: var(--text-main);">
        {{ $blog->title }}
    </h1>

    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb; color: var(--text-muted);">
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <div style="width: 40px; height: 40px; background: var(--primary-color); border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                {{ substr($blog->author->name ?? 'Admin', 0, 1) }}
            </div>
            <span><strong style="color: var(--text-main);">{{ $blog->author->name ?? 'WanderTours Admin' }}</strong></span>
        </div>
        <span style="color: #d1d5db;">•</span>
        <span>{{ $blog->created_at->format('d/m/Y') }}</span>
    </div>

    @if($blog->image)
    <div style="margin-bottom: 3rem; border-radius: var(--radius-lg); overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
        <img src="{{ $blog->image }}" alt="{{ $blog->title }}" style="width: 100%; height: auto; display: block;">
    </div>
    @endif

    <div style="font-size: 1.1rem; line-height: 1.8; color: #374151; word-wrap: break-word;">
        {!! nl2br(e($blog->content)) !!}
    </div>

</div>

<style>
    /* Styling for the content to make it look like a nice article */
    .article-content h2, .article-content h3 { margin-top: 2rem; margin-bottom: 1rem; color: var(--text-main); }
    .article-content p { margin-bottom: 1.5rem; }
    .article-content ul, .article-content ol { margin-bottom: 1.5rem; padding-left: 2rem; }
    .article-content li { margin-bottom: 0.5rem; }
</style>
@endsection
