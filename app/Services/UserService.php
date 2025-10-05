<?php

namespace App\Services;

use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\apiResponseTrait;

class UserService
{
    use apiResponseTrait;
    public function signUp(array $data)
    {
        $user = User::create([
            'name'=> $data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);
        $token=$user->createToken('user_token')->plainTextToken;
        return [
           'user' => new UserResource($user),
           'token' => $token
        ];
    }
    public function signIn(array $data)
    {
         if (!Auth::attempt($data)) {
            return [
                'message' => 'Email or password is incorrect',
                'code' => 401
            ];
        }
        $user = User::where('email',$data['email'])->firstOrFail();
        $userToken = $user->createToken('user_token')->plainTextToken;
        return [
           'user' => new UserResource($user),
           'token' => $userToken
        ];
    }


    public function logout()
    {
        $user = Auth::user();
        if(!is_null($user)  )
        {
            $user->currentAccessToken()->delete();
            return [
            'message' => 'User logged out successfuly'
        ];
        }
        else {
            return [
            'message' => 'Invalid token',
        ];
 }
    }
}


