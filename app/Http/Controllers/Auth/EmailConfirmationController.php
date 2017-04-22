<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repository\UserRepository;
use App\Http\Controllers\Controller;
use App\Events\User\ConfirmationEmailRequested;

//use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class EmailConfirmationController
 * @package App\Http\Controllers\Auth
 */
class EmailConfirmationController extends Controller
{
    private $userRepo;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest');
        $this->userRepo = $userRepository;
    }


    public function confirmEmail($token)
    {
        try {
            $this->userRepo->confirmEmail($token);
        } catch (ModelNotFoundException $e) {
            flash()->overlay('請重新認證!如有任何問題,請與我們聯絡', '認證失敗');
            return redirect('/');
        }

        flash()->overlay('您的電子信箱已認證完成!', '認證成功');

        return redirect('/');
    }


    public function showEmailVerification(Request $request)
    {
//        if ($request->ajax()) {
//            $user = auth()->user();
//            $user->generateVerifiedToken()->save();
//            $this->userMailer->emailConfirmation($user);
//            return 'success';
//        }

        return view('auth.app.emailVerification');
    }


    public function sendConfirmationEmail(Request $request)
    {
        $user = $this->userRepo->findByEmail($request->input('email'));

        if (!$user) {
            flash()->overlay('請輸入正確的電子信箱!', '電子信箱不正確');
            return redirect('/email/verification');
        }

        if ($user->verified) {
            flash()->overlay('您的信箱已認證,不須再認證!', '信箱已認證');
            return redirect('/');
        }

        //send out a confirmation email
        event(new ConfirmationEmailRequested($user));

        flash()->overlay('請收取您的電子郵件,並依照步驟認證您的電子信箱', '寄送成功');

        return redirect('/');
    }
}
