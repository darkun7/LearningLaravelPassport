<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
// use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest as Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class LoginController extends BaseController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * @OA\Post(
     *     path="/login",
     *     operationId="loginUser",
     *     tags={"Authentication"},
     *     summary="Login user",
     *     @OA\Response(
     *         response="200", description="Successful operation"
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     * )
     *
     * @param  App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login( Request $request )
    {
        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $login = [
            $loginType => $request->username,
            'password' => $request->password
        ];

        $user = $this->userRepository->getUserByLoginType($loginType, $request->username);

        if ( is_null($user) & !Auth::attempt($login) ) {
            return $this->sendError('Login failed');
        }

        $accessToken = $user->createToken('authToken')->accessToken;
        return $this->sendResponse(
            [
                'user' => Auth::user(),
                'access_token' => $accessToken
            ],
            'Login successfully.');
    }

    public function logout( Request $request )
    {
        $request->user()->tokens()->delete();
    }
}
