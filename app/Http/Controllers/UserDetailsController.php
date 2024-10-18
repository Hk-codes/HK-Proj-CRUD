<?php

namespace App\Http\Controllers;

use App\Models\UserDetails; // Import the UserDetails model
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of user details.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all user details
        $userDetails = UserDetails::all();

        return view('admin.posts.user', compact('userDetails'));
    }
}
