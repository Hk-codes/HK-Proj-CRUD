<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display all posts for normal users
    public function index()
    {
        $posts = Post::all(); // Fetch all posts
        return view('posts.index', compact('posts'));
    }
}