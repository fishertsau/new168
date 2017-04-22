<?php

namespace App\Http\Controllers\Frontend;


use App\Models\Device\Device;
use App\Http\Controllers\Controller;

/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $latestDevices = Device::latest('updated_at', 'asc')->published()->take(4)->get();
        return view('frontend.home.home', compact('latestDevices'));
    }
}
