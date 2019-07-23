<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated($request, $user) {
        if ($user->type == "user") {
            return redirect('/home');
        }
        else
        {
            return redirect('/admin');
        }   
   }

   public function redirectToProvider($provider)
   {
       return \Socialite::driver($provider)->redirect();
   }

   /**
    * Obtain the user information from GitHub.
    *
    * @return \Illuminate\Http\Response
    */
   public function handleProviderCallback($provider)
   {
       $user = \Socialite::driver($provider)->stateless()->user();
       $existed = \App\User::where('email',$user->email)->first();
       if(!$existed){
           $newUser = \App\User::create([
               'name' => $user->getName(),
               'email' => $user->getEmail(),
               'password' => Hash::make(str_random(8)),
               'type'=> 'user',
               'email_verified_at'=>\Carbon\Carbon::now(),
           ]);
           auth()->login($newUser, true);
       }
       else{
           auth()->login($existed, true);
       }
       return redirect()->to('/');
       // $user->token;
   }

}
