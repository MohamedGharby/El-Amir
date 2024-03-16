<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\FileService;
use Core\Repositories\ItemRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\Requests\ItemRequests\ItemRequest;

class ItemController extends Controller
{
    use HandleUpload;
    private $itemRepo ,$fileService;
    public function __construct(ItemRepo $itemRepo , FileService $fileService)
    {
        $this->fileService = $fileService;
        $this->itemRepo = $itemRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Items = $this->itemRepo->getItems();
        return ItemResource::collection($Items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $item = $this->itemRepo->createItem($request);
        return response()->json([
            'Message' => 'تمت الإضافه بنجاح',
            'Item' => $item,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = $this->itemRepo->getItemById($id);
        return ItemResource::make($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request , Item $item)
    {
        $action = $this->itemRepo->updateItem($request , $item);
        if ($action) {
            return response()->json([
                'Message' => 'تم التعديل بنجاح',
                'Item' => $item,
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $action = $this->itemRepo->deleteItem($item);
        if ($action) {
            if ($item->img) {
                $this->fileService->DeleteFile($item->img);
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
