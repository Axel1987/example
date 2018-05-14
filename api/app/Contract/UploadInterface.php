<?php

namespace App\Contract;

use App\Http\Request\Admin\UploadResume;

interface UploadInterface
{
    /**
     * Upload the resume file
     *
     * @param $file
     * @return mixed
     */
    public function uploadResume($file);

    /**
     * Upload avatar
     *
     * @param $file
     * @return mixed
     */
    public function uploadAvatar($file);
}