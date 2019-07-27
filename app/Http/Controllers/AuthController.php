<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request)
    {
        // TODO: add validator
        // all fields requiered
        // emails must be unique

        $organization = Organization::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json([
            'token' => $this->jwt($organization)
        ], 200);
    }

    public function login(Request $request)
    {
        // TODO: add validator
        // email and password required

        $email = $request->email;
        $organization = Organization::where('email', $email)->firstOrFail();

        if (Hash::check($request->password, $organization->password))
        {
            return response()->json([
                'token' => $this->jwt($organization),
            ], 200);
        }

        return response()->json([
            'error' => 'Incorrect email or password',
        ], 400);
    }

    protected function jwt(Organization $organization)
    {
        $payload = [
            'iss' => 'coffeepals',
            'sub' => $organization->id,
            'iat' => time(),
            'exp' => time() + 60*60 
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }
}
