<?php

namespace App\Repositories;

use App\Interfaces\UserAuthRepositoryInterface;
use App\Models\User;

class UserAuthRepository implements UserAuthRepositoryInterface
{
    public function index(){
        return User::all();
    }

    public function getById($id){
        return User::findOrFail($id);
    }

    public function store(array $data){
        return User::create($data);
    }

    public function update(array $data,$id){
        return User::whereId($id)->update($data);
    }

    public function getByEmail(string $email)
    {
        return User::whereEmail($email)->first();
    }

    public function delete($id){
        return User::destroy($id);
    }


    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
}
