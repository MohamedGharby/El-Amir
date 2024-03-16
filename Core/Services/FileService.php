<?php

namespace Core\Services;

use Illuminate\Support\Facades\Storage;
use Core\Interfaces\FileServiceInterface;

class FileService implements FileServiceInterface{
    
    private $file,$path;

    public function uploadFile()
    {
        $fileObj = $this->getFile();
        $res = $fileObj->store($this->getPath());
        return $res;
    }

    public function DeleteFile($file){
        return Storage::delete($file);
    }

    public function setFile($file){
        $this->file = $file;
    }

    public function getFile(){
        return $this->file;
    }

    public function setPath($path){
        $this->path = $path;
    }

    public function getPath(){
        return $this->path;
    }


}