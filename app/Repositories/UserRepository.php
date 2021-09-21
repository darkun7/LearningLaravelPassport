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

    public function create( array $data )
    {
        return $this->model->create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function getUserByLoginType( $column, $value )
    {
        return $this->model->where($column, $value )->first();
    }

}
