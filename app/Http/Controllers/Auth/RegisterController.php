<?php

namespace App\Http\Controllers\Auth;

use App;
use Auth;
use App\User;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\User\SignedIn;
use App\Repository\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'agreed' => 'required|accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data)
    {
        return $this->userRepository->createUser($data);
    }


    public function registerSocialite($data)
    {
        $this->handleRegister($data);
    }


    /**
     * Handle a registration request for the application.
     * @override
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user = $this->handleRegister($request->all());

        flash()->overlay('請收取我們剛寄給您的電子郵件,並依照步驟認證電子信箱', '註冊成功');
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    /**
     * @param $input
     * @return User
     */
    public function handleRegister($input)
    {
        $this->validator($input)->validate();

        event(new Registered($user = $this->create($input)));

        $this->guard()->login($user);

        event(new SignedIn(Auth::user(),Carbon::now(),request()->ip()));

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @override
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.app.register');
    }
}
