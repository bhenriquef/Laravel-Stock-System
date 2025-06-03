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

    public function login(LoginRequest $request) : JsonResponse{
        $dto = LoginDTO::fromArray($request->validated());
        $result = $this->UserAuthService->login($dto);

        return ResponseClass::sendResponse($result, 'Login Successful', 200);
    }

    public function logout(){
        $this->UserAuthService->logout();
        return ResponseClass::sendResponse('Logout Sucessful', '', 204);
    }
}
