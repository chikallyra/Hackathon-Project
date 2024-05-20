<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'), [
            "title" => "Posts"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.addPost', [
            "title" => "Create Posts"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Generate unique slug based on title
        $slug = Str::slug($validatedData['title']);

        // Jika ada file gambar di-upload, simpan ke storage dan dapatkan path-nya
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/blogs', 'public');
        } else {
            $imagePath = null;
        }

        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        // Simpan data ke database
        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->slug = $slug;
        $blog->body = $validatedData['body'];
        $blog->excerpt = Str::limit(strip_tags($validatedData['body']), 200);
        $blog->image = $imagePath;
        $blog->created_date = $currentDate;
        $blog->created_time = $currentTime;
        $blog->save();

        // Redirect dengan pesan sukses
        return redirect('/blog')->with('success', 'Blog successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog, $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $comments = Comment::where('blog_id', $blog->id)->orderBy('created_at', 'desc')->get();
        return view('blog.show', compact('blog', 'comments'), [
            "title" => "Show"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blog.editPost', compact('blog'), [
            "title" => "Edit"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
    
        $blog->title = $validatedData['title'];
        $blog->body = $validatedData['body'];
    
        // Mengunggah gambar jika ada perubahan gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/blogs', 'public');
            $blog->image = $imagePath;
        }
    
        $blog->save();
    
        return redirect()->route('blog')->with('success', 'Blog successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
    
        return redirect('/blog')->with('success', 'Post has been deleted!');
    }
}
