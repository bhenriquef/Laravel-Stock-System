<?php

namespace App\Services;

use App\Interfaces\UserAuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Classes\ResponseClass;
use Auth;

class UserAuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected UserAuthRepositoryInterface $userAuthRepository)
    {
    }

    public function login(string $email, string $password) {
        $user = $this->userAuthRepository->getByEmail($email);

        if(!$user || !Hash::check($password, $user->password)){
            return ResponseClass::throw('Invalid Credentials', 'Invalid Credentials', 401);
        }

        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return ResponseClass::sendResponse('Logged out', '', 201);
    }
}
