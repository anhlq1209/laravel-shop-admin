<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function attempt(LoginFormRequest $request) {
        $data = $request->only(['email', 'password']);
        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ])) {
            
            return redirect()->route('dashboard');
            
        }

        Session::flash('error', 'Email hoặc mật khẩu không đúng!');
        return redirect()->back()->withInput();
    }

    public function store() {

    }

    public function destroy() {
        Auth::logout();
        return redirect()->route('show-form-login');
    }
}
