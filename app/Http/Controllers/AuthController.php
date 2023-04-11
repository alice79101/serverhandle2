<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credential = $request->validate([
            'email' => 'required|email|min:3|max:255',
            'password' => 'required|alpha_num:|min:6|max:255',
        ]);

        return "Hi loginnn";
    }
}
