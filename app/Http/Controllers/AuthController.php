<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dd("aaaaaaaaaaa");

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|exists:users',
                'password' => 'required',
            ],
            $messages = [
                'email.exists' => __('Email not associated with any account'),
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                "message" => $this->readalbeError($validator),
            ], 400);
        }

        //
        $user = User::where('email', $request->email)->first();

       if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            //generate tokens
            return $this->authObject($user);
        } else {
            return response()->json([
                "message" => __("Invalid credentials. Please check your password and try again")
            ], 401);
        }
    }

    public function authObject($user)
    {


        $user = User::find($user->id);
        $token = $user->createToken($user->name)->plainTextToken;
        return response()->json([
            "token" => $token,
            "type" => "Bearer",
            "message" => __("User login successful"),
            "user" => $user,

        ]);
    }
}