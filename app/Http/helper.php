<?php 
// use Intervention\Image\Facades\Image as Image;

use Carbon\Carbon;

function upload($newFile)
{

    $filename = $newFile->getClientOriginalName();
    $newFile->move(base_path('storage/app/public'), $filename);
    return "/storage/$filename";
}


function deleteFile($filePath)
{
    $filename = basename($filePath);
    
    // Delete the file from public/storage directory
    $publicStoragePath = public_path('storage/' . $filename);
    if (file_exists($publicStoragePath)) {
        unlink($publicStoragePath);
    }
    
    // Delete the file from storage/app/public directory
    $appPublicStoragePath = storage_path('app/public/' . $filename);
    if (file_exists($appPublicStoragePath)) {
        unlink($appPublicStoragePath);
    }
}



function agoTime($timestamp)
{
    $date = Carbon::parse($timestamp);
    return $date->diffForHumans();
}
