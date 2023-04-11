<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credential = $request->validate([
            'email' => 'required|email|min:3|max:255',
            'password' => 'required|alpha_num:ascii|min:6|max:255',
        ]);
        $token = Auth::guard('api')->attempt($credential);
        abort_if( !$token, Response::HTTP_BAD_REQUEST, __('auth.loginFail'));

//        return \response([
//            'message' => 'login successful',
//            'data' => $token,
//        ]);
        return view('welcome');
//        return redirect('/dashboard');
    }
}
