<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class OperatorPostController extends Controller
{
    public function index()
    {
        // Operator can view all posts
        $posts = Post::all();
        return view('operator.posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        return view('operator.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Update the post details
    $post->name = $request->input('name');
    $post->description = $request->input('description');
    $post->price = $request->input('price');

    // Check if a new image has been uploaded
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image); // Delete the old image
        }

        // Handle the new image upload
        $imagePath = $request->file('image')->store('images', 'public');
        $post->image = $imagePath; // Update the image path in the post
    }

    // Save the updated post
    $post->save();

    session()->flash('success', 'Product Updated successfully!');


    return redirect()->route('operator.posts.index');
    }

}