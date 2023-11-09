<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResources;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    use HttpResponses;

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','register']]);
    // }
    
    public function login(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $token = Auth::attempt($formFields);
      
        if ( !$token) {
            return $this->error('', 'email or password is invalid', 401);
        }
        $user = User::where("email", $formFields['email'])->first();

        return $this->success([
            'user' => new UserResources($user),
            'authorization' => [
                'token' =>  $token,
                'type' => 'bearer',
            ]
          
        ]);
    }

    public function register(Request $request)
    {
        // dd($request);
        $formFields = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' =>'required|email|unique:users',
                'password' => [
                    'required', Password::defaults()
                ]
            ]
        );
        // Hash Password
        $formFields['password'] = Hash::make($formFields['password']);

        // Create user
        $user = User::create($formFields);
        $token = Auth::login($user);
        return $this->success([
            'user' => new UserResources( $user),
            'authorization' => [
                'token' => $token ,
                'type' => 'bearer',
            ]
          
        ],'User created successfully');
    }
    public function logout()
    {
        Auth::logout();
        return $this->success([
     ],'Logged out successfully ');

    }
   
}