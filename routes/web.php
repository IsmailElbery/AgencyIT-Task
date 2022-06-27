<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/users', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/reviewes', [App\Http\Controllers\HomeController::class, 'reviewes'])->name('reviewes');

Route::group(['prefix' => 'users'], function () {
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('userCreate');
    Route::get('/reviewers', [App\Http\Controllers\HomeController::class, 'reviewers'])->name('reviewers');
    Route::POST('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::POST('/add-reviewe', [App\Http\Controllers\HomeController::class, 'addReviewe'])->name('addReviewe');
    Route::POST('/assign-reviewer', [App\Http\Controllers\HomeController::class, 'assginReviewer'])->name('assginReviewer');
    Route::get('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
    Route::get('/update-reviewe/{id}', [App\Http\Controllers\HomeController::class, 'updateReviewe'])->name('update-reviewe');
    Route::POST('/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
    Route::POST('/editReview', [App\Http\Controllers\HomeController::class, 'editReview'])->name('editReview');
    Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
    Route::get('/delete-reviewe/{id}', [App\Http\Controllers\HomeController::class, 'deleteReviewe'])->name('delete-reviewe');
});
