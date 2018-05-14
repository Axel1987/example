<?php

namespace App\Http\Controllers;


use App\Contract\PartnerCandidateInterface;
use App\Contract\UploadInterface;
use App\Contract\UserInterface;
use App\Http\Request\CreatePartnerCandidateRequest;
use App\Service\PartnerCandidateService;
use App\Service\UploadService;
use App\Service\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PartnerController extends Controller
{
    /** @var PartnerCandidateService $partnerCandidateService */
    protected $partnerCandidateService;

    /** @var  UploadService $uploadService */
    protected $uploadService;
    
    /** @var  UserService $userService */
    protected $userService;

    /**
     * CandidateController constructor.
     */
    public function __construct()
    {
        $this->partnerCandidateService = app()->make(PartnerCandidateInterface::class);
        $this->uploadService = app()->make(UploadInterface::class);
        $this->userService = app()->make(UserInterface::class);
    }

    /**
     * @SWG\Get(
     *     tags={"PUBLIC:: Partner's methods"},
     *     path="/partner/list",
     *     summary="Get list of talent partners",
     *     description="Get list of talent partners",
     *     produces={"application/json"},
     *     @SWG\Response(
     *      response="200",
     *      description="Jobs data"
     *     )
     * )
     */
    /**
     * @param Request $request
     * @return mixed
     */
    public function getList(Request $request)
    {
        return $this->userService->index($request, 'partner');
    }

    /**
     * @SWG\Post(
     *     tags={"PUBLIC:: Partner's methods"},
     *     path="/partner/cv",
     *     summary="Send an application for partner-candidate",
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
     * @param CreatePartnerCandidateRequest $request
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function cv(CreatePartnerCandidateRequest $request)
    {
        /** @var UploadedFile $file */
        $file = $request->resume;
        $link = $this->uploadService->uploadResume($file);

        return $this->partnerCandidateService->create($request, $link);
    }
}