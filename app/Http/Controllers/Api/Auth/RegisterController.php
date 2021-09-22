<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserRepository;

class RegisterController extends BaseController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function validator( array $data )
    {
        $rules = [
            'name'=> 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|unique:users',
            'password' => 'required|string'
        ];
        return Validator::make($data,$rules);
    }

    public function register( Request $request )
    {
        $validation = $this->validator($request->all());
        if ($validation->fails()) {
            return $this->sendError('Validation Error.', $validation->errors()->all(), 400);
        }

        $user = $this->userRepository->create($request->all());

        Auth::attempt([
            'email' => $request->email,
            'password'=> $request->password
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;
        return $this->sendResponse(
            [
                'user' => Auth::user(),
                'access_token' => $accessToken
            ], __('response.SuccessStoreData'),201);
    }
}
