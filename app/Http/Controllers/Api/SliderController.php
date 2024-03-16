<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\FileService;
use Core\Repositories\SliderRepo;
use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Http\Requests\SliderRequests\SliderRequest;

class SliderController extends Controller
{
    use HandleUpload;
    private $sliderRepo ,$fileService;
    public function __construct(SliderRepo $sliderRepo , FileService $fileService)
    {
        $this->fileService = $fileService;
        $this->sliderRepo = $sliderRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = $this->sliderRepo->getSliders();
        return SliderResource::collection($sliders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $slider= $this->sliderRepo->createSlider($request);
        return response()->json([
            'Message' => 'تمت الإضافه بنجاح',
            'Slider' => $slider,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $slider= $this->sliderRepo->getSliderById($id);
        return SliderResource::make($slider);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request , Slider $slider)
    {
        $action = $this->sliderRepo->updateSlider($request , $slider);
        if ($action) {
            return response()->json([
                'Message' => 'تم التعديل بنجاح',
                'Slider' => $slider,
            ]);
        }

        return response()->json([
            'Message' => ' حدث خطأ ما ..! ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $action = $this->sliderRepo->deleteSlider($slider);
        if ($action) {
            if ($slider->img) {
                $this->fileService->DeleteFile($slider->img);
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
