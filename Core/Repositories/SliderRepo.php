<?php
namespace Core\Repositories;

use App\Models\Slider;
use App\Traits\HandleUpload;
use Illuminate\Http\Request;
use Core\Services\FileService;

Class SliderRepo{
    use HandleUpload;
    public $fileService;
    public function __construct(FileService $fileService){
        $this->fileService = $fileService;
    }
    public function getSliders(){
        return Slider::select('name' , 'img')->get();
    }

    public function getSliderById($id) {
        return Slider::findOrFail($id);
    }

    public function createSlider(Request $request){
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , null , 'sliders');
        return Slider::create($data);
    }

    public function updateSlider(Request $request , Slider $Slider){
        $data = $request->validated();
        $data['img'] = $this->handleUpload($request ,$this->fileService , $Slider->img , 'sliders');
        return $Slider->update($data);
    }

    public function deleteSlider(Slider $Slider){
        return $Slider->delete();
    }
}