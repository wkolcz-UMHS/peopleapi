<?php

namespace App\Http\Controllers;

use App\FlexNGate\Users\EloquentUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(EloquentUserRepository $user)
    {
        $this->user = $user;
    }

    public function authenticate(Request $request){
        try{
            $user = $this->user->authenicate(json_decode($request->get('user')));
            if($user){
                return response([
                    'success' => true,
                    'data' => $user,
                ],200);
            }else{
                return response([
                    'success' => false,
                    'message' => 'Incorrect username and/or password',
                ],401);
            }
        }catch(\Exception $e){
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ],400);
        }
    }
}
