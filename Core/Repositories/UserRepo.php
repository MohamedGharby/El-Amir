<?php
namespace Core\Repositories;

use Illuminate\Http\Request;
use Core\Services\AuthService;
use App\Http\Resources\UserResources\AdminResource;
use App\Http\Resources\UserResources\CustomerResource;
use App\Http\Resources\UserResources\MerchantResource;

class UserRepo{
    public $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function registerAdmin(Request $request){
        $user = $this->authService->userRegister($request);
        $token = $user->createToken("$user->name Token")->plainTextToken;
        return response()->json([
            'massage' => 'تم تسجيل الحساب بنجاح ..!!',
            'token' => $token,
            'admin' => new AdminResource($user),
        ]);
    }

    public function registerCustomer(Request $request){
        $user = $this->authService->userRegister($request);
        $token = $user->createToken("$user->name Token")->plainTextToken;
        return response()->json([
            'massage' => 'تم تسجيل الحساب بنجاح ..!!',
            'token' => $token,
            'customer' => new CustomerResource($user),
        ]);
    }

    public function registerMerchant(Request $request){
        $user = $this->authService->userRegister($request);
        $token = $user->createToken("$user->name Token")->plainTextToken;
        return response()->json([
            'massage' => 'تم تسجيل الحساب بنجاح ..!!',
            'token' => $token,
            'merchant' => new MerchantResource($user),
        ]);
    }

    //Loging In

    public function logingIn(Request $request){
        return $this->authService->userLogin($request);
    }

    //Loging Out

    public function logingOut(Request $request)  {
        $this->authService->userLogout($request);
        return response()->json([
            'message' => "تم الخروج..!!"
        ]);
    }
}