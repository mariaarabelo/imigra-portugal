<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReportController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContentController;

use App\Http\Controllers\MainController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

// Home
Route::get('/', [MainController::class, 'index']);

// About
Route::get('/about', [MainController::class, 'about']);

// Help
Route::get('/help', [MainController::class, 'help']);

// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// Questions
Route::get('/tag/questions/{idTag}', [QuestionController::class, 'showByTag'])->name('questions.byTag');
Route::get('/questions/create/{idTag}', [QuestionController::class, 'create'])->name('questions.create');
Route::get('/questions/edit/{id}/{idTag}', [QuestionController::class, 'edit'])->name('questions.edit');
Route::get('/search', [MainController::class, 'search'])->name('search');
Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');
Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
Route::delete('/questions/{id}/{idTag}', [QuestionController::class, 'destroy'])->name('questions.destroy');
Route::delete('/questions/{id}', [QuestionController::class, 'destroyQuestion'])->name('questions.destroyQuestion');

// Answers
Route::get('/answers/{questionId}', [AnswerController::class, 'getAnswers'])->name('getAnswers');
Route::post('/answers/create', [AnswerController::class, 'store'])->name('answers.store');
Route::delete('/answers/{id}/{idTag}', [AnswerController::class, 'destroy'])->name('answers.destroy');
Route::put('/answers/{id}', [AnswerController::class, 'update'])->name('answers.update');
Route::delete('/answers/{id}', [AnswerController::class, 'destroyAnswer'] )->name('answers.destroyAnswer');

// Comments
Route::post('/comments/question/create', [CommentController::class, 'storeQ'])->name('comments.storeQ');
Route::post('/comments/answer/create', [CommentController::class, 'storeA'])->name('comments.storeA');
Route::delete('/comments/{id}/{idTag}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');

// Vote
Route::post('/vote', [VoteController::class, 'store'])->name('content.vote');

// Notifications
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

// Profile
Route::get('/profiles/{userId}', [ProfileController::class, 'show'])->name('profile.show');

Route::group(['middleware' => 'profile'], function () {
    Route::put('/profiles/updateEmail/{userId}', [ProfileController::class, 'updateEmail'])->name('profile.updateEmail');
    Route::put('/profiles/updatePass/{userId}', [ProfileController::class, 'updatePass'])->name('profile.updatePass');
});

// Moderator
Route::middleware(['moderator'])->group(function () {
    Route::get('/reports', [ReportController::class, 'showModeratorReports'])->name('reports.show');
    Route::get('/moderator', [ReportController::class, 'show'])->name('moderator.show');
    //Moderator Tags
    Route::get('/moderator/tags', [ReportController::class, 'showTags'])->name('moderator.showTags');
    Route::get('/moderator/create/tag', [ReportController::class, 'showCreateTagForm'])->name('moderator.showCreateTag');
    Route::post('/moderator/create/tag', [ReportController::class, 'storeTag'])->name('moderator.storeTag');
    Route::get('/moderator/search-tag/{redirect}', [ReportController::class, 'showSearchTag'])->name('moderator.searchTag');
    Route::post('/moderator/search-tag', [ReportController::class, 'searchTag']);
    Route::get('/moderator/edit/tag/{id}', [ReportController::class, 'editTag'])->name('moderator.editTag');
    Route::put('/moderator/tag/update/{id}', [ReportController::class, 'updateTag'])->name('moderator.updateTag');
    Route::get('/moderator/delete/tag/{id}', [ReportController::class, 'deleteTag'])->name('moderator.deleteTag');
    Route::delete('/moderator/destroy/tag/{id}', [ReportController::class, 'destroyTag'])->name('moderator.destroyTag');
});

//delete content
Route::delete('/contents/{id}',  [ContentController::class, 'destroyContent'])->name('contents.destroyContent');

// Admin
Route::group(['middleware' => 'admin'], function () {
    //Admin User
    Route::get('/admin', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.showUsers');
    Route::get('/admin/create/user', [AdminController::class, 'showCreateUserForm'])->name('admin.showCreateUser');
    Route::post('/admin/create/user', [AdminController::class, 'storeUser'])->name('admin.storeUser');
    Route::get('/admin/search-user/{redirect}', [AdminController::class, 'showSearchUser'])->name('admin.searchUser');
    Route::post('/admin/search-user', [AdminController::class, 'searchUser']);
    Route::get('/admin/edit/user/{id}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::put('/admin/user/update/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::get('/admin/delete/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::delete('/admin/destroy/user/{id}', [AdminController::class, 'destroyUser'])->name('admin.destroyUser');
    Route::get('/admin/blocked/users', [AdminController::class, 'blockedUsers'])->name('admin.blockedUsers');
    Route::put('/admin/block-user/{id}', [AdminController::class, 'blockUser'])->name('admin.blockUser');
    Route::put('/admin/unblock-user/{id}', [AdminController::class, 'unblockUser'])->name('admin.unblockUser');
    //Admin Tags
    Route::get('/admin/tags', [AdminController::class, 'showTags'])->name('admin.showTags');
    Route::get('/admin/create/tag', [AdminController::class, 'showCreateTagForm'])->name('admin.showCreateTag');
    Route::post('/admin/create/tag', [AdminController::class, 'storeTag'])->name('admin.storeTag');
    Route::get('/admin/search-tag/{redirect}', [AdminController::class, 'showSearchTag'])->name('admin.searchTag');
    Route::post('/admin/search-tag', [AdminController::class, 'searchTag']);
    Route::get('/admin/edit/tag/{id}', [AdminController::class, 'editTag'])->name('admin.editTag');
    Route::put('/admin/tag/update/{id}', [AdminController::class, 'updateTag'])->name('admin.updateTag');
    Route::get('/admin/delete/tag/{id}', [AdminController::class, 'deleteTag'])->name('admin.deleteTag');
    Route::delete('/admin/destroy/tag/{id}', [AdminController::class, 'destroyTag'])->name('admin.destroyTag');
});

