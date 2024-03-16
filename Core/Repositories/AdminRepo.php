<?php
namespace Core\Repositories;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRepo{
    public function getAdmins(){
        $role_id = Role::where('name','Admin')->first()->id;
        return User::select('id','email','name','phone','address','password')->where('role_id' , $role_id )->paginate(10);
    }

    public function getAdminByID($id) {
        $role_id = Role::where('name','Admin')->first()->id;
        $user = User::where('role_id' , $role_id);
        if ($user) {
            return $user->findOrFail($id);  
        }
        return throw new Exception("غير موجود ..!!", 404);
    }

    public function updateAdmin(Request $request , User $Admin){
        
        $role_id = Role::where('name','Admin')->first()->id;
        $user = User::where('role_id' , $role_id);
        if ($user) {
            $data = $request->validated();
            return $Admin->update($data); 
        }
        return throw new Exception("غير موجود ..!!", 404);
    }


    public function deleteAdmin(User $Admin) {
        return $Admin->delete();
    }
}