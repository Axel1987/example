<?php

namespace App\Service;

use App\Contract\UploadInterface;
use App\Http\Request\Admin\UploadResume;
use Illuminate\Http\UploadedFile;
use Storage;

class UploadService implements UploadInterface
{
    /**
     * Upload the resume file
     *
     * @param $file
     * @return mixed
     */
    public function uploadResume($file)
    {
        $path = $file->store('resume', env('STORAGE_DISC', 'public'));

        return Storage::disk(env('STORAGE_DISC', 'public'))->url($path);
    }

    /**
     * Upload avatar
     * 
     * @param $file
     * @return mixed
     */
    public function uploadAvatar($file)
    {
        $path = $file->store('avatar', env('STORAGE_DISC', 'public'));

        return Storage::disk(env('STORAGE_DISC', 'public'))->url($path);
    }
}