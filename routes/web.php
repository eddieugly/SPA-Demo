<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

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
Route::get('login', [LoginController::class, 'index'])->name('login');

Route::post('login', [LoginController::class, 'check'])->name('login');

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {
    
    Route::get('/', [HomeController::class, 'home']);
    
    Route::get('/users', [HomeController::class, 'index']);
    
    Route::get('/users/create', [HomeController::class, 'create']);
    
    Route::post('/users', [HomeController::class, 'store']);

    Route::get('users/{user}/edit', [HomeController::class, 'edit']);

    Route::put('users/{user}/', [HomeController::class, 'update']);
    
    Route::delete('users/{user}/destroy', [HomeController::class, 'destroy'])->can('can:delete');
    
    Route::get('/settings', [HomeController::class, 'settings']);
});
