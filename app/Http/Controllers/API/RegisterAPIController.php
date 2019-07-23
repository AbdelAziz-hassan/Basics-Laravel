<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;

class RegisterAPIController extends Controller
{
    //
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'name'    => 'required',
            'email'   => 'email|unique:users',
            'password' => 'required',
        ]);
        if($validation->fails())
        {
            $errors = $validation->errors();
            return $this->sendError($errors->first(),-1);       
        }
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'type'     => 'user',
            'slug'    => getSlug($data['name'],User::class)
         ]);

        $token = auth('api')->login($user);
        $user=auth('api')->user();
        $user->token=$token;
        $user->token_expires= auth('api')->factory()->getTTL() * 60;
        return $this->sendResponse($user, 0,'Registration Success');
   }
}
