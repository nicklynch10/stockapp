<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $email = $request->email ?? '';
        return view('auth.register',compact('email'));
    }
}

