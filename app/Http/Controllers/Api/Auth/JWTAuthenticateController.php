<?php


namespace app\Http\Controllers\Api\Auth;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\User\SignedIn;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Repository\UserRepository;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Auth\RegisterController;

class JWTAuthenticateController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepo;
    /**
     * @var RegisterController
     */
    private $registerController;


    /**
     * JWTAuthenticateController constructor.
     * @param UserRepository $userRepository
     * @param RegisterController $registerController
     */
    public function __construct(
        UserRepository $userRepository, RegisterController $registerController
    )
    {
        $this->userRepo = $userRepository;
        $this->registerController = $registerController;
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (!$this->validEmail($credentials)) {
            return response()->json($this->errMsg('wrong email'), 401);
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json($this->errMsg('invalid_credentials'), 401);
            }
        } catch (JWTException $e) {
            return response()->json($this->errMsg('could_not_create_token'), 500);
        }

        event(new SignedIn(Auth::user(), Carbon::now(), request()->ip()));
        $status = 'success';
        $user = Auth::user();

        return response()->json(compact('status', 'token', 'user'), 200);
    }

    /**
     * @param string $msg
     * @return array
     */
    private function errMsg($msg = 'request can not be proceeded.')
    {
        return [
            'status' => 'error',
            'message' => $msg
        ];
    }

    /**
     * @param $credentials
     * @return mixed
     */
    private function validEmail($credentials)
    {
        return $this->userRepo->findByEmail($credentials['email']);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'logout successful!'
        ], 200);
    }

    public function register(Request $request)
    {
        $user = $this->registerController->handleRegister($request->all());

        $status = 'success';
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('status', 'user', 'token'), 200);
    }
}