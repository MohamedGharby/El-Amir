<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Core\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequests\AdminAuthRequest;
use App\Http\Requests\AuthRequests\CustomerAuthRequest;
use App\Http\Requests\AuthRequests\MerchantAuthRequest;

class AuthController extends Controller
{
    public $userRepo;
    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    //Registering
    public function adminRegister(AdminAuthRequest $request) {
        return $this->userRepo->registerAdmin($request);
    }

    public function customerRegister(CustomerAuthRequest $request) {
        return $this->userRepo->registerCustomer($request);
    }

    public function merchantRegister(MerchantAuthRequest $request) {
        return $this->userRepo->registerMerchant($request);
    }

    //Login
    public function superAdminLogin(Request $request){
        return $this->userRepo->logingIn($request);
    }

    public function adminLogin(Request $request){
        return $this->userRepo->logingIn($request);
    }

    public function customerLogin(Request $request){
        return $this->userRepo->logingIn($request);
    }

    public function merchantLogin(Request $request){
        return $this->userRepo->logingIn($request);
    }


    //Logout 
    public function logout(Request $request) {
        return $this->userRepo->logingOut($request);
    }
}
