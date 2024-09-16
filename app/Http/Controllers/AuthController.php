<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials)) {
            return redirect('/');
        }

        return redirect('/login');

    }

    public function assignRole(Request $request, User $user, Role $role) {
        $user->assignRole($role);
        return redirect()->back()->with('success', 'Role assigned successfully.');
    }
}
