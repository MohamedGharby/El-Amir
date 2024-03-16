<?php
namespace Core\Services;

use App\Models\User;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Class AuthService{
    use HandleUpload;

    //Registering
    public function userRegister(Request $request){
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        return User::create($data);
    }

    public function userMerchantRegister(Request $request , FileService $fileService){
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        $data['img'] = $this->handleUpload($request ,$fileService , null , 'Merchants');
        return User::create($data);
    }

    //Login

    public function userLogin(Request $request){
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (! Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return response()->json([
                'message' => 'يوجد خطأ فى البيانات ..!',
            ],401);
        }

        $user = Auth::user();
        $token = $user->createToken("$user->name Token")->plainTextToken;
        return response()->json([
            'message' => 'تم تسجيل الدخول بنجاح',
            'user_name' => $user->name,
            'token' => $token
        ],401);

    }

    //Logout
    public function userLogout(Request $request){
        return $request->user()->currentAccessToken()->delete();
    }


    //----------------------------------------------------//

    
}