<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SocialRegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Public routes
Route::prefix('/')->group(function () {
	Route::post('login', [SessionController::class, 'login']);
	Route::post('register', [SessionController::class, 'register'])->name('register');
	Route::get('verify-account', [SessionController::class, 'verify'])->name('verification.verify');
	Route::post('reset-password', [PasswordController::class, 'send'])->name('reset.password');
	Route::get('reset-check', [PasswordController::class, 'check'])->name('check');
	Route::post('update-password', [PasswordController::class, 'update'])->name('update.password');
	Route::get('google-register/{locale}/{type}', [SocialRegisterController::class, 'redirectToProvider'])->name('google.register');
	Route::get('auth/google/{locale}/{type}/callback', [SocialRegisterController::class, 'handleCallBack'])->name('google.register.callback');
	Route::get('verify-email', [ProfileController::class, 'verifyEmail'])->name('verify.email');
});

//Auth routes
Route::prefix('/auth')->middleware(['auth:sanctum'])->group(function () {
	Route::get('/user', [UserController::class, 'me']);
	Route::get('/movie-tags', [MovieController::class, 'tags']);
	Route::post('/movie-upload', [MovieController::class, 'store']);
	Route::get('/user-movies', [MovieController::class, 'index']);
	Route::get('/movie/{id}', [MovieController::class, 'get']);
	Route::put('/movie/{id}', [MovieController::class, 'update']);
	Route::delete('/movie/{id}', [MovieController::class, 'destroy']);
	Route::post('/quote-upload', [QuoteController::class, 'store']);
	Route::delete('/quote/{id}', [QuoteController::class, 'destroy']);
	Route::get('/get-quote', [QuoteController::class, 'get']);
	Route::put('/quote/{id}', [QuoteController::class, 'update']);
	Route::post('/quote-like', [LikeController::class, 'store']);
	Route::post('/comment-upload', [CommentController::class, 'store']);
	Route::post('/logout-user', [SessionController::class, 'logout']);
	Route::get('/news-feed', [NewsFeedController::class, 'index']);
	Route::get('/auth-movies', [NewsFeedController::class, 'movies']);
	Route::post('/new-quote', [NewsFeedController::class, 'store']);
	Route::get('/user-notifications', [NotificationController::class, 'index']);
	Route::put('/read-notification', [NotificationController::class, 'read']);
	Route::get('/check-username', [ProfileController::class, 'checkUser']);
	Route::get('/check-email', [ProfileController::class, 'checkEmail']);
	Route::put('/update-profile', [ProfileController::class, 'update']);
	Route::post('/add-email', [ProfileController::class, 'store']);
	Route::delete('/delete-email', [ProfileController::class, 'delete']);
	Route::put('/change-primary-email', [ProfileController::class, 'updatePrimary']);
	Route::put('/update-username', [ProfileController::class, 'updateName']);
	Route::post('/change-password', [ProfileController::class, 'updatePassword']);
});
