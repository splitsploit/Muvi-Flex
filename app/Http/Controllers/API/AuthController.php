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

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $user = User::where('email', $request->email)->first();

        if($user) {

            $isValidPassword = Hash::check($request->password, $user->password);

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

        $jwtKey = env('JWT_KEY');
        $jwtExpired = env('JWT_EXPIRED');

        $now = now()->timestamp;
        $expired = now()->addMinutes($jwtExpired)->timestamp;

        $payload = [
            'iss' => 'muvi-flex', // issued by
            'iat' => $now, // issued at
            'nbf' => $now, // active at
            'exp' => $expired,
            'user' => $user
        ];

        $token = JWT::encode($payload, $jwtKey, 'HS256');

        return $token;
    }
}
