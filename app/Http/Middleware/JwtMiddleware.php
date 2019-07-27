<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Organization;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->get('token');

        if (!$token) {
            return response([
                'error' => 'Token not provided',
            ], 401);
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => 'Provided token has expired'
            ], 400);
        } catch( Exception $e) {
            return response()->json([
                'error' => 'An error while decoding token'
            ], 400);
        }

        $organization = Organization::find($credentials->sub);
        $request->auth = $organization;

        return $next($request);
    }
}
