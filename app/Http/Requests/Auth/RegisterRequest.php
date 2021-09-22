<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\RequestTrait;

/**
 * @OA\Schema(
 *      title="RegisterRequest",
 *      description="Create new user by register",
 *      type="object",
 *      required={"name", "username", "email", "password"}
 * )
 */
class RegisterRequest extends FormRequest
{
    use RequestTrait;
    /**
     * @OA\Property(
     *      title="name"
     * )
     * @var string
     */
    private $name;
     /**
     * @OA\Property(
     *      title="username"
     * )
     * @var string
     */
    private $username;
     /**
     * @OA\Property(
     *      title="email", example="test@mail.com"
     * )
     * @var string
     */
    private $email;
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
            'name'=> 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|unique:users',
            'password' => 'required|string'
        ];
    }
}
