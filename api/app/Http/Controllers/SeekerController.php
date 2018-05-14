<?php

namespace App\Http\Controllers;

use App\Contract\CandidateInterface;
use App\Contract\UploadInterface;
use App\Http\Request\CreateCandidateRequest;
use App\Service\CandidateService;
use App\Service\UploadService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SeekerController extends Controller
{
    /** @var CandidateService $candidateService */
    protected $candidateService;

    /** @var  UploadService $uploadService */
    protected $uploadService;

    /**
     * CandidateController constructor.
     */
    public function __construct()
    {
        $this->candidateService = app()->make(CandidateInterface::class);
        $this->uploadService = app()->make(UploadInterface::class);
    }

    /**
     * @SWG\Post(
     *     tags={"PUBLIC:: Candidate's methods"},
     *     path="/seeker/cv",
     *     summary="Send an application for job seeker",
     *     description="",
     *     consumes={"multipart/form-data"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="Resume file",
     *         in="formData",
     *         name="resume",
     *         required=false,
     *         type="file"
     *     ),
     *     @SWG\Parameter(
     *         description="Candidate's name",
     *         in="formData",
     *         name="name",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Candidate's email",
     *         in="formData",
     *         name="email",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Candidate's phone",
     *         in="formData",
     *         name="phone",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="Candidate's data"
     *     )
     * )
     */
    /**
     * @param CreateCandidateRequest $request
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function cv(CreateCandidateRequest $request)
    {
        /** @var UploadedFile $file */
        $file = $request->resume;
        $link = $this->uploadService->uploadResume($file);

        return $this->candidateService->create($request, $link);
    }
}