<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminPostController extends Controller
{
    public function index()
    {
        // Admin can see all posts
        $posts = Post::all();
        
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    // public function store(Request $request)
    // {
        
    //     Post::create([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'price' => $request->price,
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

    //         'user_id' => Auth::id(),
    //     ]);
    //     // Debugging: Log the request data
    //     Log::info($request->all());
    //     // Check if the image file exists
    //     if ($request->hasFile('image')) {
    //         // Handle the image upload
    //         $imagePath = $request->file('image')->store('images', 'public');
    
    //         // Create a new post with the uploaded image path
    //         Post::create([
    //             'name' => $request->name,
    //             'description' => $request->description,
    //             'price' => $request->price,
    //             'image' => $imagePath,
    //         ]);
    
    //         return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    //     }
    
    //     return redirect()->back()->withErrors('Image not uploaded.');
    // }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Debugging: Log the request data
        Log::info($request->all());
        // Check if the image file exists
        if ($request->hasFile('image')) {
            // Handle the image upload
            $imagePath = $request->file('image')->store('images', 'public');
    
            // Create a new post with the uploaded image path
            Post::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $imagePath,
                'user_id' => auth()->id()
            ]);


    
            return redirect()->route('admin.posts.index')->with('success', 'Product created successfully!');;
        }
    
        return redirect()->back()->withErrors('Image not uploaded.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
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

    return redirect()->route('admin.posts.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
{
    // Find the post by ID or fail
    $post = Post::findOrFail($id);

    // Check if the post has an associated image and delete it
    if ($old_image = $post->image) {
        Storage::disk('public')->delete($old_image);
    }

    // Delete the post
    $post->delete();
    

    return redirect()->route('admin.posts.index')->with('success', 'Product Deleted successfully.');
}
}