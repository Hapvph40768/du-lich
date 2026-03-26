<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class PublicBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('author')
            ->where('status', 'published')
            ->latest()
            ->paginate(12);
            
        return view('blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::with('author')
            ->where('status', 'published')
            ->findOrFail($id);
            
        return view('blogs.show', compact('blog'));
    }
}
