<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('index');
        $this->middleware('auth')->only('logout');
    }
    public function index()
    {
        return view('login');
    }
    public function login(UserLoginRequest $request)
    {
        $credential = $request->validated();
        return Auth::attempt($credential)
            ? redirect()->to('/dashboard')
            : redirect()->back()->with('err', 'Login failed!');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->to('/auth/login');
    }
}