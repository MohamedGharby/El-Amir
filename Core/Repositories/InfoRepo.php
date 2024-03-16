<?php
namespace Core\Repositories;

use Exception;
use App\Models\Info;
use Illuminate\Http\Request;

class InfoRepo{
    public function getInfos() {
        return Info::select('id' , 'name' , 'email' , 'phone', 'address', 'facebook' , 'x' , 'instagram','linkedIn')->get();
    }

    public function getInfoByID($id){
        $info = Info::findOrFail($id);
        if (! $info ) {
            throw new Exception(' غير موجود ..!!'  , 403); 
        }
        return $info;
    }

    public function createInfo(Request $request){
        $data = $request->validated();
        return Info::create($data);
    }

    public function updateInfo(Request $request , Info $info){
        $data = $request->validated();
        return $info->update($data);
    }

    public function deleteInfo(Info $info){
        return $info->delete();
    }
}