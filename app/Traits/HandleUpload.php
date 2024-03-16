<?php

namespace App\Traits;


trait HandleUpload{

  public function handleUpload($request , $fileService , $currentImage = null , $path){
      
       if (! $request->has('img')) {
           if ($currentImage!= null) {
              return substr($currentImage , 8 );
           }
           return null;
       }

       if ($currentImage != null) {
            $deletedPath = substr($currentImage , 8 );
           $fileService->DeleteFile($deletedPath);
       }
         
       $fileService->setPath($path);
       $fileService->setFile($request['img']);
       return $fileService->uploadFile();

  }

}