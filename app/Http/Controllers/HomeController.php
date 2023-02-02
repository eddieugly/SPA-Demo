<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function home()
    {
        return Inertia::render('Home');
    }

    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user),
                        'delete' => Auth::user()->can('delete', $user)
                    ]
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    }

    public function create()
    {
        if (Request::user()->cannot('create', User::class)) {
            abort(403);
        }
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        // Validate Request
        $attributes = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // Create User
        User::create($attributes);

        return redirect('/users')->with('success', 'User Created Successfully');
    }

    public function edit(User $user)
    {
        if (Request::user()->cannot('edit', User::class)) {
            abort(403);
        }

        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]
        ]);
    }

    public function update(User $user)
    {

        if (Request::user()->cannot('update', User::class)) {
            abort(403);
        }
        // Validate & Update User

        $user->update(
            Request::validate([
                'name' => 'required',
                'email' => ['required', 'email'],
                'password' => 'required'
            ])

        );

        return redirect('/users')->with('success', 'User Updated Successfully');
    }

    public function settings(User $user)
    {
        return Inertia::render('Settings');
    }

    public function destroy(User $user)
    {

        if (Request::user()->cannot('delete', User::class)) {
            abort(403);
        }
        $user->delete();

        return Redirect::back()->with('success', 'User Deleted Successfully');
    }
}
