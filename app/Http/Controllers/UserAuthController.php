<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserAuthService;
use Illuminate\Http\Request;
use App\Classes\ResponseClass;
use App\Http\Resources\UserAuthResource;
use Illuminate\Support\Facades\DB;
use App\Interfaces\UserAuthRepositoryInterface;

class UserAuthController extends Controller
{
    private UserAuthService $userAuthService;
    private UserAuthRepositoryInterface $userAuthRepositoryInterface;

    public function __construct(UserAuthService $userAuthService,  UserAuthRepositoryInterface $userAuthRepositoryInterface)
    {
        $this->userAuthService = $userAuthService;
        $this->userAuthRepositoryInterface = $userAuthRepositoryInterface;
    }

    public function register(Request $request){
         $details = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        DB::beginTransaction();
        try{
            $user = $this->userAuthRepositoryInterface->store($details);

            DB::commit();
            return ResponseClass::sendResponse(new UserAuthResource($user), 'User Create Successful', 201);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }   
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $result = $this->userAuthService->login($request->email, $request->password);

        return ResponseClass::sendResponse($result, 'Login Successful', 200);
    }

    public function logout(){
        $this->userAuthService->logout();
        return ResponseClass::sendResponse('Logout Sucessful', '', 204);
    }
}
