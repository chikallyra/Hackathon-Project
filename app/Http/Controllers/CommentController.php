<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'blog_id' => 'required|exists:blogs,id', 
            'body' => 'required|string|max:255', 
        ]);

        $comment = new Comment();
        $comment->blog_id = $validatedData['blog_id'];
        $comment->user_id = auth()->id(); 
        $comment->body = $validatedData['body'];

        $comment->save();

        $blog = Blog::findOrFail($validatedData['blog_id']); // Asumsi ada relasi blog_id di Comment model

        return redirect()->route('blog.show', ['slug' => $blog->slug])
            ->with('success', 'Comment added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
