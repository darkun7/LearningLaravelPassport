<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
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

    public function validator( array $data )
    {
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string'
        ];
        return Validator::make($data,$rules);
    }

    public function login( Request $request )
    {
        $validation = $this->validator($request->all());
        if ($validation->fails()) {
            return $this->sendError('Validation Error.', $validation->errors()->all(), 400);
        }
        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $login = [
            $loginType => $request->username,
            'password' => $request->password
        ];

        $user = $this->userRepository->getUserByLoginType($loginType, $request->username);

        if (!Auth::attempt($login)) {
            return response([
                'message' => 'Login failed'
            ]);
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
