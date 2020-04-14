<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public $successStatus = 200;

    public function login(Request $request) {

        if(Auth::attempt(['email' => $request->get('login'), 'password' => $request->get('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('Blog')-> accessToken;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>['Unauthorised']], 401);
        }
    }
}
