<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\StoryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('stories', [StoryController::class, 'index'])->name('admin.stories.index');
    Route::get('stories/create', [StoryController::class, 'create'])->name('admin.stories.create');
    Route::post('stories', [StoryController::class, 'store'])->name('admin.stories.store');
});

Route::get('notice-board', [StoryController::class, 'index'])->name('notice-board');
Route::get('approve-story/{story}', [StoryController::class, 'approve'])->name('approve-story');
Route::get('notice-board/index', [StoryController::class, 'approvedStories'])->name('notice-board.approved-stories');

