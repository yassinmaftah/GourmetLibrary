<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\BorrowController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);

    // Route::get('/books', [BookController::class, 'index']);

    Route::post('/books/{id}/borrow', [BorrowController::class, 'store']);
    Route::post('/books/{id}/return', [BorrowController::class, 'returnBook']);
    Route::get('/my-books', [BorrowController::class, 'myBooks']);
});

Route::get('/books', [BookController::class, 'index']);
Route::delete('/books/{book}', [BookController::class, 'destroy']);
Route::get('/books/{book}', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{book}', [BookController::class, 'update']);
