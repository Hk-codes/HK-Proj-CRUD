{{-- <!-- resources/views/user.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">User Login & Logout Details</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>User ID</th>
                    <th>Last Login At</th>
                    <th>Last Logout At</th>
                </tr>
            </thead>
            <tbody>
                @if ($userDetails->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center">No user details found.</td>
                    </tr>
                @else
                    @foreach ($userDetails as $details)
                        <tr>
                            <td>{{ $details->user_id }}</td>
                            <td>{{ $details->last_login_at ? $details->last_login_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td>{{ $details->last_logout_at ? $details->last_logout_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection --}}






@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">User Login & Logout Details</h1>

    <div class="table-responsive">
        
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Last Login At</th>
                    <th>Last Logout At</th>
                </tr>
            </thead>
            <tbody>
                @if ($userDetails->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center">No user details found.</td>
                    </tr>
                @else
                    @foreach ($userDetails as $details)
                        <tr class="text-center">
                            <td >{{ $details->user_id }}</td>
                            <td >{{ $details->user_name }}</td>
                            <td>{{ $details->last_login_at ? $details->last_login_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td>{{ $details->last_logout_at ? $details->last_logout_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
</div>
@endsection
