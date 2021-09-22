<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="LoginRequest",
 *      description="Authenticate user by username (or email) and password",
 *      type="object",
 *      required={"name", "username", "email", "password"}
 * )
 */
class LoginRequest extends FormRequest
{
    use RequestTrait;
    /**
     * @OA\Property(
     *      title="username"
     * )
     * @var string
     */
    private $username;
     /**
     * @OA\Property(
     *      title="password", example="password"
     * )
     * @var string
     */
    private $password;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string'
        ];
    }
}
