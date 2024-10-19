<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\AuthRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.auth');
    }

    public function store(AuthRequest $request, User $user)
    {
        $data = $request->validated();

        $remember = $request->has('remember');

        if (Auth::attempt($data, $remember)) {
            return redirect()->intended(route('home', absolute: false));
        }

        return back()->withErrors([
            'error' => 'Неправильный логин или пароль.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
