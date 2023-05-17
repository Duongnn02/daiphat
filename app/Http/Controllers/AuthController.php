<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // public function register()
    // {
    //     return view('auth.auth-register-basic');
    // }

    public function handlleRegister(Request $request)
    {
        dd($request->all());
    }
}
