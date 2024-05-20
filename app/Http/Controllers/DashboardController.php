<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

class DashboardController extends Controller
{
    public function index() {
        $blogs = Blog::all();
        return view('dashboard', compact('blogs'), [
            "title" => "Dashboard"
        ]);
    }
}
