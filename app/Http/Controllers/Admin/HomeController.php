<?php namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

/**
 * Class HomeController
 * @package App\Http\Controllers\Admin
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
		if (Auth::check())
            return View('admin/index');
        else
            return Redirect::to('login')->with('error', 'You must be logged in!');
    }

}