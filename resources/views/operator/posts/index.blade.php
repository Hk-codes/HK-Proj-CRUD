@extends('layouts.app')

@section('content')
<div class="container">
    
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h1>All Posts</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Prize</th>
                <th>Product Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->name }}</td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->price }}</td>
                
                <td>
                    <div class="mb-3">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="img-thumbnail mt-2" style="max-width: 200px;">
                        @endif
                    </div>
                 </td>
                <td>
                     <a href="{{ route('operator.posts.edit', $post->id) }}" class="btn btn-warning">Edit</a> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection