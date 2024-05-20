<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $credentials['email'])->first();

    return redirect()->route('dashboard')->with('success', 'Youre Loged In');

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}

}

