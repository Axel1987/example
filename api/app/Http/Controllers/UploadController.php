<?php

namespace App\Http\Controllers;

use App\Contract\UploadInterface;
use App\Http\Controllers\Controller;
use App\Http\Request\Admin\UploadResume;
use App\Service\UploadService;

class UploadController extends Controller
{
    /** @var  UploadService $uploadService */
    protected $uploadService;

    /**
     * UploadController constructor.
     */
    public function __construct()
    {
        $this->uploadService = app()->make(UploadInterface::class);
    }

    /**
     * @SWG\Post(
     *     tags={"UPLOAD:: Upload methods"},
     *     path="/upload/resume",
     *     summary="",
     *     description="",
     *     consumes={"multipart/form-data"},
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *         description="file to upload",
     *         in="formData",
     *         name="resume",
     *         required=false,
     *         type="file"
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @param UploadResume $request
     * @return mixed
     */
    public function resume(UploadResume $request)
    {
        return $this->uploadService->uploadResume($request);
    }
}