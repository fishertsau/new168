<?php

namespace App\Http\Controllers\Auth\FisherCustom;

use Auth;
use Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class PasswordController
 * @package App\Http\Controllers\Auth\FisherCustom
 */
class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/';
    protected $subject = '密碼重新設定!';
    protected $linkRequestView = 'auth.passwords.email';
    protected $resetView = 'auth.passwords.reset';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['passwordreset','showResetForm']]);
    }


    public function passwordreset(Request $request)
    {
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6',
                'confirmPassword' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return redirect('/admin')
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = Auth::user();
            $password = $request->get('password');
            $user->password = Hash::make($password);
            $user->save();
        }
    }
}
