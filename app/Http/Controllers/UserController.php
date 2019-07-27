<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends BaseController
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

    public function create(Request $request) 
    {
        $organization = $request->auth;
        $users = $request->users;
        foreach ($users as $user) {
            $user = User::create([
                'email' => $user['email'],
                'organization_id' => $organization->id,
            ]);
        }
    }

    public function read(Request $request) 
    {
        return response()->json($request->auth->users);
    }

    public function update() 
    {
        return ;
    }

    public function delete() 
    {
        return ;
    }
}