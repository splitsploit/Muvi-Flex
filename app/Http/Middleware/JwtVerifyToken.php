<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\Key;
use Throwable;

class JwtVerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $jwtKey = env('JWT_KEY');
        $jwt = $request->bearerToken();

        try {
            $token = JWT::decode($jwt, new Key($jwtKey, 'HS256'));

            dd($token);

            return $next($request);

        } catch (BeforeValidException $e) {
            return response()->json(['message' => 'Token Not Valid Yet'], 401);

        } catch (SignatureInvalidException $e) {
            return response()->json(['message' => 'Invalid Token Signature']);

        } catch (ExpiredException $e) {

            return response()->json(['message' => 'Token Expired!']);

        } catch (\Throwable $e) {
            return response()->json(['message' => 'Unauthorized!']);
        }

    }
}
