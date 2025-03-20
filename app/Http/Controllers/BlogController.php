<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $title = "Blog";
        $blogs = Blog::withCount('comments')->latest()->paginate(10); // Get the latest 10 blogs
        return view('blog.index', compact('blogs', 'title'));
    }

    public function show(Blog $blog)
    {
        $comments = $blog->comments()->latest()->get();
        return view('blog.show', compact('blog', 'comments'));
    }

    public function storeComment(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
        ]);

        $blog->comments()->create([
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'author' => $request->author,
        ]);

        return redirect()->route('blog.show', $blog)->with('success', 'Blog created successfully!');
    }
}
