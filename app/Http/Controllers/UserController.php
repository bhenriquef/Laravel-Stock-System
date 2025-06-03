<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserAuthService;
use Illuminate\Http\Request;
use App\Classes\ResponseClass;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private UserAuthService $UserAuthService;
    private UserRepositoryInterface $UserRepositoryInterface;

    public function __construct(UserAuthService $UserAuthService,  UserRepositoryInterface $UserRepositoryInterface)
    {
        $this->UserAuthService = $UserAuthService;
        $this->UserRepositoryInterface = $UserRepositoryInterface;
    }

    /**
     * Users | New
     * 
     * Store a newly created user in database.
     */

    public function register(Request $request){
         $details = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        DB::beginTransaction();
        try{
            $user = $this->UserRepositoryInterface->store($details);

            DB::commit();
            return ResponseClass::sendResponse(new UserResource($user), 'User Create Successful', 201);
        } catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }   
    }
}
