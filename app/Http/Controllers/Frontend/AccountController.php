<?php

namespace App\Http\Controllers\Frontend;


use Auth;
use App\User;
use Acme\Tool\Likeable\Like;
use App\Models\Device\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class AccountController
 * @package App\Http\Controllers\Frontend
 */
class AccountController extends Controller
{
    /**
     * AccountController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->middleware("modelOwner:user")->only(['update']);
    }


    public function index()
    {
        $user = Auth::user();
        $userDevices = $user->devices()->get();

        $likeDeviceIds = Like::where('user_id', $user->id)
            ->where('likeable_type', get_class(new Device))
            ->pluck('likeable_id');

        $likeDevices = Device::whereIn('id', $likeDeviceIds)->get();


        return view('frontend.users.account',
            compact('user', 'userDevices', 'likeDevices'));
    }


    public function update(User $user, Request $request)
    {
        $allowedFields = ['email', 'name'];
        $user->update($request->intersect($allowedFields));
    }
}
