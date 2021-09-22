<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{

    public function __construct()
    {
        $this->model = new User;
    }

    /**
     * create
     *
     * @param  array $data
     * @return User
     */
    public function create( array $data ) : User
    {
        return $this->model->create([
            'name'     => $data['name'],
            'username' => strtolower($data['username']),
            'email'    => strtolower($data['email']),
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * getUserByLoginType
     *
     * @param  string $column (email/username)
     * @param  string $value
     * @return mixed
     */
    public function getUserByLoginType( $column, $value )
    {
        return $this->model->where($column, $value )->first();
    }

}
