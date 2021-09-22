<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
// use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest as Request;
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

    /**
     * @OA\Post(
     *     path="/register",
     *     operationId="registerUser",
     *     tags={"Authentication"},
     *     summary="Create new user record",
     *     @OA\Response(
     *         response="200", description="Successful operation"
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *      ),
     * )
     *
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register( Request $request )
    {
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
