<?php
namespace Core\Repositories;

use App\Models\Product;
use App\Models\Product_img;
use Core\Services\FileService;
use Illuminate\Http\Request;
use App\Traits\HandleUpload;

Class ProductRepo {
    use HandleUpload;
    public $fileService;
    public function __construct(FileService $fileService){
        $this->fileService = $fileService;
    }
    
    public function getProducts(){
        return Product::with('item')->paginate(10);
    }

    public function getProductById($id) {
        return Product::findOrFail($id);
    }

    public function createProduct(Request $request){
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , null , 'products');
        return Product::create($data);
    }

    public function updateProduct(Request $request , Product $product){
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , $product->img , 'products');
        return $product->update($data);
    }

    public function deleteProduct(Product $product){
        return $product->delete();
    }

    //Product Images

    public function getAllProductsImgs(){
        return Product_img::with('product')->paginate(10);
    }

    public function getOneProductImages($productId) {
        return Product_img::where('product_id' , $productId)->get();
    }

    public function getProductImgById($id) {
        return Product_img::findOrFail($id);
    }

    public function createProductImg(Request $request){
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , null , 'products');
        return Product_img::create($data);
    }

    public function updateProductImg(Request $request , Product_img $image){
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , $image->img , 'products');
        return $image->update($data);
    }

    public function deleteProductImg(Product_img $image){
        return $image->delete();
    }
}