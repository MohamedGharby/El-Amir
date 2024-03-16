<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Traits\HandleUpload;
use Core\Services\FileService;
use Core\Repositories\CategoryRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryRequests\CategoryAddReq;
use App\Http\Requests\CategoryRequests\CategoryUpdateReq;

class CategoryController extends Controller
{
    use HandleUpload;
    private $categoryRepo ,$fileService;
    public function __construct(CategoryRepo $categoryRepo , FileService $fileService)
    {
        $this->fileService = $fileService;
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryRepo->getCategories();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryAddReq $request)
    {
        $category = $this->categoryRepo->createCategory($request);
        return response()->json([
            'Message' => 'تمت الإضافه بنجاح',
            'Category' => $category,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = $this->categoryRepo->getCategoryById($id);
        return CategoryResource::make($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateReq $request , Category $category)
    {
        $action = $this->categoryRepo->updateCategory($request , $category);
        if ($action) {
            return response()->json([
                'Message' => 'تم التعديل بنجاح',
                'Category' => $category,
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $action = $this->categoryRepo->deleteCategory($category);
        if ($action) {
            if ($category->img) {
                $this->fileService->DeleteFile($category->img);
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
