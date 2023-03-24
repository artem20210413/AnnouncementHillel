<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Post\PostController;
use App\Policies\PostPolicy;
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
Route::get('/', [PostController::class, 'list'])->name('list');
Route::get('/{post}/show', [PostController::class, 'show']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'handleLogin']);
    Route::get('/restore', [AuthController::class, 'showRestore'])->name('restore');
    Route::post('/restore', [AuthController::class, 'handleRestore']);
    Route::get('/restore/{guid}', [AuthController::class, 'restoreCheckGuid']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::get('/registration ', [AuthController::class, 'showRegistration'])->name('registration');
    Route::post('/registration', [AuthController::class, 'handleRegistration']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/edit/{post}', [PostController::class, 'edit']);
    Route::get('/edit', [PostController::class, 'create']);

    Route::post('/save', [PostController::class, 'save']);//->can('show', PostPolicy::class);//->middleware('can:isShow,post');
    Route::delete('/delete/{post}', [PostController::class, 'delete']);

});
