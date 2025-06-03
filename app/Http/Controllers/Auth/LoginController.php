<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserAuthService;
use Illuminate\Http\Request;
use App\Classes\ResponseClass;
use App\DTOs\LoginDTO;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    private UserAuthService $UserAuthService;

    public function __construct(UserAuthService $UserAuthService)
    {
        $this->UserAuthService = $UserAuthService;
    }

    /**
     * Login
     * 
     */

    public function login(LoginRequest $request) : JsonResponse{
        $dto = LoginDTO::fromArray($request->validated());
        $result = $this->UserAuthService->login($dto);

        return ResponseClass::sendResponse($result, 'Login Successful', 200);
    }

    /**
     * Logout
     * 
     * @authenticated
     */

    public function logout(){
        $this->UserAuthService->logout();
        return ResponseClass::sendResponse('Logout Sucessful', 'Logout Sucessful', 204);
    }
}
