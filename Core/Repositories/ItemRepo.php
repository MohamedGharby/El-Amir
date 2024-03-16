<?php
namespace Core\Repositories;

use App\Models\Item;
use Core\Services\FileService;
use Illuminate\Http\Request;
use App\Traits\HandleUpload;

Class ItemRepo {
    use HandleUpload;
    public $fileService;
    public function __construct(FileService $fileService){
        $this->fileService = $fileService;
    }
    
    public function getItems(){
        return Item::with('category')->select('id' , 'name' , 'img' , 'category_id')->paginate(10);
    }

    public function getItemById($id) {
        return Item::findOrFail($id);
    }

    public function createItem(Request $request){
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , null , 'items');
        return Item::create($data);
    }

    public function updateItem(Request $request , Item $item){
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , $item->img , 'items');
        return $item->update($data);
    }

    public function deleteItem(Item $item){
        return $item->delete();
    }
}