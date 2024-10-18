<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\AdminPostController ;
use App\Http\Controllers\Operator\OperatorPostController ;
use App\Http\Controllers\UserDetailsController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("/redirects", function(){

    if(auth()->user()->role==2){
        return redirect()->route('admin.posts.index');
    }
    elseif(auth()->user()->role==1){
        return redirect()->route('operator.posts.index');
    }
    else{
        return redirect()->route('posts.index');
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
    Route::put('/admin/posts/{post}', [AdminPostController::class, 'update'])->name('posts.update'); // This is the update route
    Route::get('/admin/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
    Route::post('/admin/posts', [AdminPostController::class, 'store'])->name('posts.store');
    Route::get('/admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.delete');
    // Route::get('/admin/posts/user', [UserDetailsController::class, 'index'])->name('post.user');

    Route::get('/admin/users', [UserDetailsController::class, 'index'])->name('posts.user'); 

});

// Operator routes
Route::middleware(['auth', 'operator'])->prefix('operator')->name('operator.')->group(function () {
    Route::get('/posts/{post}/edit', [OperatorPostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [OperatorPostController::class, 'update'])->name('posts.update'); // Update route
    Route::post('/posts', [OperatorPostController::class, 'store'])->name('posts.store'); // Store route
    Route::get('/operator/posts', [OperatorPostController::class, 'index'])->name('posts.index');
});

// Normal user can view posts (no authentication needed)
 Route::get('/posts', [PostController::class, 'index'])->name('posts.index');