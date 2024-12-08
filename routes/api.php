<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\FeedBackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);

Route::post('/add/contact', [ContactController::class, 'addContact']);
Route::get('/contacts', [ContactController::class, 'index']);

Route::post('/items', [ItemController::class, 'addItem']);
Route::get('/items', [ItemController::class, 'index']);
Route::patch('/items/{id}/status', [ItemController::class, 'updateStatus']);

Route::get('/feedbacks', [FeedBackController::class, 'index']);
Route::post('/feedbacks', [FeedBackController::class, 'addFeedback']);