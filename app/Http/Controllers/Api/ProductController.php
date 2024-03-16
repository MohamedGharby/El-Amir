<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\FileService;
use Core\Repositories\ProductRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequests\ProductRequest;

class ProductController extends Controller
{
    use HandleUpload;
    private $productRepo ,$fileService;
    public function __construct(ProductRepo $productRepo , FileService $fileService)
    {
        $this->fileService = $fileService;
        $this->productRepo = $productRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepo->getProducts();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productRepo->createProduct($request);
        return response()->json([
            'Message' => 'تمت الإضافه بنجاح',
            'Product' => $product,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->productRepo->getProductById($id);
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request , Product $product)
    {
        $action = $this->productRepo->updateProduct($request , $product);
        if ($action) {
            return response()->json([
                'Message' => 'تم التعديل بنجاح',
                'Product' => $product,
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $action = $this->productRepo->deleteProduct($product);
        if ($action) {
            if ($product->img) {
                $this->fileService->DeleteFile($product->img);
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
