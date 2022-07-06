<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersApiController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function getSingleUser(User $user)
    {
        return $user;
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        return User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);
    }

    public function update(User $user)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $success = $user->update([
            'name' => request('name'),
            'email' => request('email'),
        ]);

        return [
            'success' => $success
        ];
    }

    public function destroy(User $user)
    {
        $success = $user->delete();

        return [
            'success' => $success
        ];
    }

}
