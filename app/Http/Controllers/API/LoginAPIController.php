<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginAPIController extends Controller
{
    //

    public function login(Request $request) {
        $validation = Validator::make($request->all(),[ 
            'email'   => 'email|required',
            'password' => 'required',
        ]);
        if($validation->fails())
        {
            $errors = $validation->errors();
            return $this->sendError($errors->first(),-1);       
        }
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return $this->sendError('Not Authorized',-1);
        }    
        $user=auth('api')->user();
        $user->token=$token;
        $user->token_expires= auth('api')->factory()->getTTL() * 60;
        return $this->sendResponse($user, 0,'Login Success');
    }
}
