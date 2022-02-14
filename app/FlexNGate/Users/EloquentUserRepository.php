<?php

namespace App\FlexNGate\Users;

use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository
{
        public function authenicate($cred){
            $user = User::where('email',$cred->email)->first();
            if(!$user || !Hash::check($cred->password, $user->password)){
                return false;
            }

            $token = $user->createToken('fng')->plainTextToken;
            return [
                'user_id' => $user->id,
                'token' => $token
            ];
        }

        public function create($user){
            User::create([
                'email' => $user->email,
                'role' => $user->role,
                'name' => $user->name,
                'password' => $user->password,
            ]);
        }

        public function get_role_by_token($header){
           $user = auth('auth')->user();
            dd($user);
        }
}
