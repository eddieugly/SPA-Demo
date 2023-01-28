<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

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
            'email' => $user->email
        ]),
        'filters' => Request::only(['search'])
    ]);
});

Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
});

Route::post('/users', function () {
    // Validate Request
    $attributes = Request::validate([
        'name' => 'required',
        'email' => ['required', 'email'],
        'password' => 'required'
    ]);

    // Create User
    User::create($attributes);

    return redirect('/users');
});

Route::delete('users/{id}/destroy', function ($id) {
    // Validate Request
    $user = User::findOrFail($id);
    $user->destroy($id);

    return back();
});

Route::get('/settings', function () {
    return Inertia::render('Settings');
});

Route::post('/logout', function () {
    dd(request('foo'));
});
