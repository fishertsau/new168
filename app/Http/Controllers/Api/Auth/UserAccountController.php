<?php

namespace App\Http\Controllers\Api\Auth;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAccountController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepo;


    /**
     * UserAccountController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function hasEmail(Request $request)
    {
        $exists = $this->userRepo->findByEmail($request->only('email')) ? true : false;
        return response()->json(compact('exists'));
    }
}
