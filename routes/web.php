<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\Interest;
use Illuminate\Http\Request;
use App\Http\Controllers\UserInterestController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/interests/{field}', [UserInterestController::class, 'getInterestsByField']);


Route::middleware(['auth'])->group(function () {
    Route::get('/interests', [UserInterestController::class, 'showInterestForm'])->name('interests.form');

    Route::post('/interests', [UserInterestController::class, 'saveInterests'])->name('interests.save');
});

Route::middleware(['auth'])->group(function () {
    // Show all posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    
    // Show the create post form
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    
    // Handle the post creation
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    
    // Show a single post
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});


require __DIR__.'/auth.php';
