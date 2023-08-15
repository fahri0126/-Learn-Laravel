<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', ['halaman' => 'Login']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns|unique:users',
            'password' => 'required'

        ]);
    }
}
