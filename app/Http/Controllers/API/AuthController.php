<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public function auth(Request $request) {

        // rule validate email & password
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // if validator fails
        if($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        // if validator success, check request email user
        $user = User::where('email', $request->email)->first();

        // if email user valid, continue process
        if($user) {

            // check request password
            $isValidPassword = Hash::check($request->password, $user->password);

            // if request password, true..
            if($isValidPassword){

                // generate token
                $token = $this->generateToken($user);
                return response()->json([
                    'message' => 'Token Successfull Generated',
                    'token' => $token
                ]);
            }
        }

        return response()->json(['message' => 'invalid credentials'], 400);
    }

    private function generateToken($user) {

        // call from env
        $jwtKey = env('JWT_KEY');
        $jwtExpired = env('JWT_EXPIRED');

        // get timestamp ( now )
        $now = now()->timestamp;

        // expired = now + add minutes then get the timestamp
        $expired = now()->addMinutes($jwtExpired)->timestamp;

        // payload
        $payload = [
            'iss' => 'muvi-flex', // issued by
            'iat' => $now, // issued at
            'nbf' => $now, // active at
            'exp' => $expired,
            'user' => $user
        ];

        // encode an JWT with payload, $jwtKey, and HS256 type encryption
        $token = JWT::encode($payload, $jwtKey, 'HS256');

        // return
        return $token;
    }
}
