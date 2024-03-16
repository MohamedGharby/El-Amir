<?php

namespace App\Http\Controllers\Api;

use App\Models\Product_img;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\FileService;
use Core\Repositories\ProductRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductImgsResource;
use App\Http\Requests\ProductRequests\ProductImgsRequest;

class ProductImgsController extends Controller
{
    use HandleUpload;
    private $productImgRepo ,$fileService;
    public function __construct(ProductRepo $productImgRepo , FileService $fileService)
    {
        $this->fileService = $fileService;
        $this->productImgRepo = $productImgRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productImgs = $this->productImgRepo->getAllProductsImgs();
        return ProductImgsResource::collection($productImgs);
    }

    public function oneProductImages($productId){
        $productImgs = $this->productImgRepo->getOneProductImages($productId);
        return ProductImgsResource::collection($productImgs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductImgsRequest $request)
    {
        $productImg = $this->productImgRepo->createProductImg($request);
        return response()->json([
            'Message' => 'تمت الإضافه بنجاح',
            'Product_images' => $productImg,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $productImg = $this->productImgRepo->getProductImgById($id);
        return ProductImgsResource::make($productImg);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductImgsRequest $request , Product_img $productImg)
    {
        $action = $this->productImgRepo->updateProductImg($request , $productImg);
        if ($action) {
            return response()->json([
                'Message' => 'تم التعديل بنجاح',
                'Product_image' => $productImg,
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product_img $productImg)
    {
        $action = $this->productImgRepo->deleteProductImg($productImg);
        if ($action) {
            if ($productImg->img) {
                $this->fileService->DeleteFile($productImg->img);
            }
            return response()->json([
                'Message' => 'تم الحذف بنجاح',
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }
}
