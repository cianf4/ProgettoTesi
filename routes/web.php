<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GroupCallController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SingleCallController;
use App\Http\Controllers\SingleEventController;
use Illuminate\Support\Facades\Route;

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

// Welcome
Route::get('/', function () {
    return view('welcome');
})->middleware('guest')
    ->name('welcome');

// Homepage
Route::get('/dashboard', [Controller::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'approved'])
    ->name('dashboard');

// Approval Request
Route::get('/approval-request', function () {
    return view('approval_request');
})->middleware(['auth', 'approved.redirect'])
    ->name('approval.request');

// Groups
Route::get('/groups', [GroupController::class, 'index'])
    ->middleware(['auth', 'verified', 'approved'])
    ->name('groups.index');
Route::get('/groups/{group}', [GroupController::class, 'show'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('groups.show');
Route::get('/groups-create', [GroupController::class, 'create'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('groups.create');
Route::post('/groups', [GroupController::class, 'store'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('groups.store');
Route::put('/groups/{group}', [GroupController::class, 'edit'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('groups.edit');
Route::post('/groups/{group}/add', [GroupController::class, 'add'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('groups.add');
Route::delete('/groups/{group}/remove-user/{user}', [GroupController::class, 'remove'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('groups.remove');
Route::delete('/groups/{group}', [GroupController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('groups.destroy');

// Events
Route::get('/groups/{group}/events', [EventController::class, 'index'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('events.index');
Route::get('/groups/{group}/events/{event}', [EventController::class, 'show'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('events.show');
Route::get('/groups/{group}/events-create', [EventController::class, 'create'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('events.create');
Route::post('/groups/{group}/events', [EventController::class, 'store'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('events.store');
Route::post('/groups/{group}/events/{event}', [EventController::class, 'cancel'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('events.cancel');
Route::delete('/groups/{group}/events/{event}', [EventController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('events.destroy');
// Single event
Route::get('/SingleEvent', [SingleEventController::class, 'index'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('singlecall.index');
Route::get('/create', [SingleEventController::class, 'create'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('single_events.create');
Route::post('/create', [SingleEventController::class, 'store'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('single_events.store');
Route::get('/singlecalls/{SingleEvent}', [SingleEventController::class, 'show'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('Single_call.show');

//Single call
Route::get('/lobby', [SingleCallController::class, 'lobby'])->name('lobby');

//Group call
Route::get('/room', [GroupCallController::class, 'room'])->name('room');



// Posts
Route::get('/groups/{group}/posts', [PostController::class, 'index'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('posts.index');
Route::get('/groups/{group}/posts/{post}', [PostController::class, 'show'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('posts.show');
Route::get('/groups/{group}/posts-create', [PostController::class, 'create'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('posts.create');
Route::post('/groups/{group}/posts', [PostController::class, 'store'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('posts.store');
Route::delete('/groups/{group}/posts/{post}', [PostController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('posts.destroy');

// Comments
Route::post('/groups/{group}/posts/{post}', [CommentController::class, 'store'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('comments.store');
Route::delete('/groups/{group}/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('comments.destroy');

// Replies
Route::post('/groups/{group}/posts/{post}/comments/{comment}', [ReplyController::class, 'store'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('replies.store');
Route::delete('/groups/{group}/posts/{post}/comments/{comment}/replies/{reply}', [ReplyController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('replies.destroy');

// Attachments
Route::get('/groups/{group}/posts/{post}/attachments/{attachment}-{attachment_name}', [AttachmentController::class, 'show'])
    ->middleware(['auth', 'verified', 'approved', 'is_member'])
    ->name('attachments.show');

// Pending Users
Route::get('/pending-users', [AdminController::class, 'showPendingUsers'])
    ->middleware(['auth', 'verified', 'approved', 'is_admin'])
    ->name('admin.pending_users');
Route::patch('/approve-user/{user}', [AdminController::class, 'approveUser'])
    ->middleware(['auth', 'verified', 'is_admin'])
    ->name('admin.approve_user');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->middleware('approved')
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});



require __DIR__.'/auth.php';
