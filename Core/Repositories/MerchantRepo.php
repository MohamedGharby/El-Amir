<?php
namespace Core\Repositories;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\FileService;

class MerchantRepo{
    use HandleUpload;
    public $fileService;
    public function __construct(FileService $fileService){
        $this->fileService = $fileService;
    }
    public function getMerchants(){
        $role_id = Role::where('name','Merchant')->first()->id;
        return User::select('id','email','name','phone','address','password')->where('role_id' , $role_id )->paginate(10);
    }

    public function getMerchantByID($id) {
        $role_id = Role::where('name','Merchant')->first()->id;
        $user = User::where('role_id' , $role_id);
        if ($user) {
            return $user->findOrFail($id);  
        }
        return throw new Exception("غير موجود ..!!", 404);
    }

    public function updateMerchant(Request $request , User $merchant){
        
        $role_id = Role::where('name','Merchant')->first()->id;
        $user = User::where('role_id' , $role_id);
        if ($user) {
            $data = $request->validated();
            $data['img'] = $this->handleUpload($request ,$this->fileService , $merchant->img , 'merchants');
            return $merchant->update($data); 
        }
        return throw new Exception("غير موجود ..!!", 404);
    }
}