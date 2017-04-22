<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class LockScreenController
 * @package App\Http\Controllers\Auth
 */
class LockScreenController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getLockScreen()
    {
        // only if user is logged in
        if (Auth::check()) {
            \Session::put('locked', true);

            $user = Auth::user();
            return view('admin.auth.lockscreen', compact('user'));
        }
        return redirect('/login');
    }


    public function postLockScreen(Request $request)
    {
        // if user in not logged in
        if (!\Auth::check())
            return redirect('/login');

        $password = $request->get('password');

        if (\Hash::check($password, \Auth::user()->password)) {
            \Session::forget('locked');
            return redirect('/admin');
        }

        //handle the password mismatch errors
        return redirect('admin/lockscreen');
    }
}