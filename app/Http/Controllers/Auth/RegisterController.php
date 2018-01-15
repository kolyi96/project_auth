<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\SocialProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cookie;
use Socialite;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $referred_by = Cookie::get('referral');
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'friend_id'   => $referred_by,
        ]);
        if($user) {
			$user->roles()->attach(3);
		}
        return $user;
    }
    
        /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try{
            $socialUser = Socialite::driver($provider)->user();
        }catch(\Exception $e){
            return redirect('/');
        }
        
        $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();
        
        //if we don't have provider and user, we create new user with provider'
        if(!$socialProvider){
            $user = User::where('email',$socialUser->getEmail())->first();
            if(!$user){
                $referred_by = Cookie::get('referral');
                $user = User::firstOrCreate([
                    'email' => $socialUser->getEmail(),
                    'name' => $socialUser->getName(),
                    'friend_id' => $referred_by,
                    'password' => bcrypt(rand(6,255))
                ]);
            
                if($user) {
        			$user->roles()->attach(3);
        		}
            }
            
            $user->socialProviders()->create([
                'provider_id' =>$socialUser->getId(),
                'provider' => $provider
            ]);
        }
        else{
            $user = $socialProvider->user;
        }
        
        auth()->login($user);
        return redirect('/home');
    }
}
