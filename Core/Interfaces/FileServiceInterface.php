<?php

namespace Core\Interfaces;


interface FileServiceInterface{
    public function uploadFile();
    public function DeleteFile($file);
    public function setFile($file);
    public function setPath($path);
    public function getFile();
    public function getPath();
}