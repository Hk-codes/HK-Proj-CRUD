@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row-6">
        <div class="col-12">
            <h1 class="mb-4 text-center">Manage Posts</h1>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            
            <!-- Create Post Button -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-plus-circle"></i> Create Post
                </a>
                <a href="{{ route('admin.posts.user') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-plus-circle"></i> Show Users & Timings
                </a>
            </div>

            <!-- Posts Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped align-middle">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Product Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <!-- Post Details -->
                            <td class="text-center">{{ $post->name }}</td>
                            <td class="text-center">{{ $post->description }}</td>
                            <td class="text-success text-center">${{ number_format($post->price, 2) }}</td>

                            <!-- Product Image -->
                            <td class="text-center">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Product Image" class="img-thumbnail" style="max-width: 100px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <!-- Action Buttons -->
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm me-2"> <!-- Added 'me-2' for margin -->
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('GET') <!-- Change this to DELETE method for actual delete request -->
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            
        </div>
    </div>
</div>
@endsection

