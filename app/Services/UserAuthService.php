<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Classes\ResponseClass;
use App\DTOs\LoginDTO;

class UserAuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected UserRepositoryInterface $UserRepository)
    {
    }

    public function login(LoginDTO $dto) : array {
        $user = $this->UserRepository->getByEmail($dto->email);

        if(!$user || !Hash::check($dto->password, $user->password)){
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
