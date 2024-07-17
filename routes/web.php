<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StoryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('stories', [StoryController::class, 'index'])->name('admin.stories.index');
    Route::get('stories/create', [StoryController::class, 'create'])->name('admin.stories.create');
    Route::post('stories', [StoryController::class, 'store'])->name('admin.stories.store');
});

Route::get('approve-story/{token}/{story}', [StoryController::class, 'approve'])->name('approve-story');
Route::get('notice-board/{token}/{id}', [StoryController::class, 'notice_board'])->name('notice-board');
