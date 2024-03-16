<?php

namespace App\Http\Controllers\Api;

use App\Models\Info;
use Illuminate\Http\Request;
use Core\Repositories\InfoRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\InfoResource;
use App\Http\Requests\InfoRequests\InfoRequest;

class InfoController extends Controller
{
    private $infoRepo;
    public function __construct(InfoRepo $infoRepo)
    {
        $this->infoRepo = $infoRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infos = $this->infoRepo->getInfos();
        return InfoResource::collection($infos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InfoRequest $request)
    {
        $info = $this->infoRepo->createInfo($request);
        return response()->json([
            'Message' => 'تمت الإضافه بنجاح',
            'Info' => $info,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->infoRepo->getInfoByID($id);
        return InfoResource::make($info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InfoRequest $request, Info $info)
    {
        $action = $this->infoRepo->updateInfo($request , $info);
        if ($action) {
            return response()->json([
                'Message' => 'تم التعديل بنجاح',
                'Info' => $info,
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Info $info)
    {
        $action = $this->infoRepo->deleteInfo($info);
        if ($action) {
            return response()->json([
                'Message' => 'تم الحذف بنجاح',
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }
    
}
