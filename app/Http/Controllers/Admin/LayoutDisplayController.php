<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class LayoutDisplayController
 * @package App\Http\Controllers\Admin
 */
class LayoutDisplayController extends Controller
{
    /**
     * @param null $data
     * @param Request $request
     * @return mixed
     */
    public function changeLeftMenuVisibilitySetting($data = null, Request $request)
    {
        $request->session()->put('left_menu_show', $request->input('left_menu_show'));

        return session('left_menu_show');
    }
}
