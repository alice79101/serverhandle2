<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
           'name' => 'required|string|min:3|max:255',
           'email' => 'required|email|min:3|max:255',
           'password' =>  'required|min:6|max:255|confirmed',
        ]);
        abort_if(
            User::where('email', $request->input('email'))->first(),
            Response::HTTP_BAD_REQUEST,
            __("此 email 已經註冊過囉！")
        );

        $user = User::create(
            array_merge(
                $validated, ['password' => Hash::make($validated['password'])]
            )
        );
        return \response([
            'message' => 'register successful',
            'user' => $user,
        ], 201);
    }
}
