<?php
namespace Core\Repositories;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerRepo{
    public function getCustomers(){
        $role_id = Role::where('name','Customer')->first()->id;
        return User::select('id','email','name','phone','address','password')->where('role_id' , $role_id )->paginate(10);
    }

    public function getCustomerByID($id) {
        $role_id = Role::where('name','Customer')->first()->id;
        $user = User::where('role_id' , $role_id);
        if ($user) {
            return $user->findOrFail($id);  
        }
        return throw new Exception("غير موجود ..!!", 404);
    }

    public function updateCustomer(Request $request , User $customer){
        
        $role_id = Role::where('name','Customer')->first()->id;
        $user = User::where('role_id' , $role_id);
        if ($user) {
            $data = $request->validated();
            return $customer->update($data); 
        }
        return throw new Exception("غير موجود ..!!", 404);
    }
}