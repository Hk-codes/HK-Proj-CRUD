@extends('layouts.app')

@section('content')
<div class="container">

    <h1>All Posts</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Prize</th>
                <th>Product Image</th>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection