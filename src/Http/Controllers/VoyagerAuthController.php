<?php

namespace CHG\Voyager\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CHG\Voyager\Facades\Voyager;
use phpseclib\Crypt\Hash;

class VoyagerAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $http;

    /**
     * TokenProxy constructor.
     * @param $http
     */
    public function __construct(\GuzzleHttp\Client $http)
    {
        $this->http = $http;
    }

    public function login()
    {
        cas()->authenticate();
    }

    public function postLogin(Request $request)
    {
        $this->validateLogin($request, [
            'email' => 'required',
            'password' => 'required | min:6'
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

//        $username = $request->usr_id;
//        $password = $request->password;
//        $user = Voyager::model('User')->where('usr_id', $username)->first();
//        if (!isset($user)) {
//            $response = $this->http->post(env('POS_AUTH_ADDR'), [
//                'form_params' => ['usr_id'=>$username, 'password'=>$password]
//            ]);
//            if ($response) {
//
//            }else{
//
//            }
//            $token = json_decode((string)$response->getBody(), true);
//            $info = $this->http->get(env('POS_USER_ADDR'),[
//                'headers' => ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token['access_token']]
//            ]);
//
//            if ($info) {
//                $user->name = $info['usr_name'];
//                $user->email = $info['email_addr'];
//                $user->password = bcrypt($password);
//                $user->avatar = 'users/default.png';
//                $user->role_id = 2;
//                $user->usr_id = $username;
//                $this->guard()->login($user);
//            } else {
//
//            }
//
//
//        }
//        $credentials = $this->credentials($request);
//        dd($credentials);

        if ($this->guard()->attempt(['usr_id'=>$request->email, 'password'=>$request->password], $request->has('remember'))) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /*
     * Preempts $redirectTo member variable (from RedirectsUsers trait)
     */
    public function redirectTo()
    {
        return config('voyager.user.redirect', route('voyager.dashboard'));
    }
}