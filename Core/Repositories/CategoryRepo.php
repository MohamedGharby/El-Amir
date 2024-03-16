<?php
namespace Core\Repositories;

use Exception;
use App\Models\Category;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\FileService;

Class CategoryRepo {
    use HandleUpload;
    public $fileService;
    public function __construct(FileService $fileService){
        $this->fileService = $fileService;
    }
    
    public function getCategories(){
        return Category::select('id' , 'name' , 'img')->paginate(10);
    }

    public function getCategoryById($id) {
        $category =  Category::findOrFail($id);
        if (! $category) {
           throw new Exception(' غير موجود ..!!'  , 403); 
        }
        return $category;
    }

    public function createCategory(Request $request){
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , null , 'Cats');
        return Category::create($data);
    }

    public function updateCategory(Request $request , Category $category){
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , $category->img , 'Cats');
        return $category->update($data);
    }

    public function deleteCategory(Category $category){
        return $category->delete();
    }
}