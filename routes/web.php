<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

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
    
    Route::get('/', function () {
        return Inertia::render('Home');
    });
    
    Route::get('/users', function () {
        return Inertia::render('Users/Index', [
            'users' => User::query()
            ->when(Request::input('search'), function($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'can' => [
                    'edit' => Auth::user()->can('edit', $user)
                ]
            ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    });
    
    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    })->can('can:create', 'App\Models\User');
    
    Route::post('/users', function () {
        // Validate Request
        $attributes = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
    
        // Create User
        User::create($attributes);
    
        return redirect('/users')->with('success', 'User Created Successfully');
    });
    
    Route::delete('users/{id}/destroy', function ($id) {
        $user = User::findOrFail($id);
        $user->destroy($id);
    
        return redirect('/users')->with('success', 'User Deleted Successfully');;
    })->can('can:delete', 'App\Models\User');
    
    Route::get('/settings', function () {
        return Inertia::render('Settings');
    });
});
