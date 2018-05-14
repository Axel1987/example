<?php

namespace App\Http\Controllers\Admin;

use App\Candidate;
use App\Contract\PartnerCandidateInterface;
use App\Contract\UploadInterface;
use App\Http\Controllers\Controller;
use App\Http\Request\Admin\CreatePartnerCandidateRequest;
use App\Http\Request\Admin\EditPartnerCandidateRequest;
use App\PartnerCandidate;
use App\Service\PartnerCandidateService;
use App\Service\UploadService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PartnerCandidateController extends Controller
{
    /** @var PartnerCandidateService $partnerCandidateService */
    protected $partnerCandidateService;

    /** @var  UploadService $uploadService */
    protected $uploadService;
    
    /**
     * CandidateController constructor.
     */
    public function __construct()
    {
        $this->partnerCandidateService = app()->make(PartnerCandidateInterface::class);
        $this->uploadService = app()->make(UploadInterface::class);
    }

    /**
     * @SWG\Get(
     *     tags={"ADMIN:: Partner-candidate's methods"},
     *     path="/admin/partner-candidates",
     *     summary="Get list of partner-candidates with pagination",
     *     description="Get list of partner-candidates with pagination",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="page",
     *          in="query",
     *          type="integer",
     *          description="Number of page",
     *          default="1",
     *          required=true
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->partnerCandidateService->index($request);
    }

    /**
     * @SWG\Post(
     *     tags={"ADMIN:: Partner-candidate's methods"},
     *     path="/admin/partner-candidates",
     *     summary="Add new partner-candidate",
     *     description="",
     *     consumes={"multipart/form-data"},
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
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
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @param CreatePartnerCandidateRequest $request
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function create(CreatePartnerCandidateRequest $request)
    {
        /** @var UploadedFile $file */
        $file = $request->new_resume;
        $link = $this->uploadService->uploadResume($file);
        
        return $this->partnerCandidateService->create($request, $link);
    }

    /**
     * @SWG\Post(
     *     tags={"ADMIN:: Partner-candidate's methods"},
     *     path="/admin/partner-candidates/{id}",
     *     summary="Edit partner-candidate",
     *     description="",
     *     consumes={"multipart/form-data"},
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="id",
     *          type="integer",
     *          in="path",
     *          description="Candidate's id",
     *          required=true,
     *     ),
     *     @SWG\Parameter(
     *         description="Resume file",
     *         in="formData",
     *         name="new_resume",
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
     *     @SWG\Parameter(
     *         description="Candidate's link to resume (old)",
     *         in="formData",
     *         name="resume",
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
     * @param PartnerCandidate $partnerCandidate
     * @param EditPartnerCandidateRequest $request
     * @return mixed
     */
    public function edit(PartnerCandidate $partnerCandidate, EditPartnerCandidateRequest $request)
    {
        /** @var UploadedFile $file */
        $file = $request->new_resume;

        if($file){
            $link = $this->uploadService->uploadResume($file);
        }else{
            $link = null;
        }
        
        return $this->partnerCandidateService->edit($partnerCandidate, $request, $link);
    }
}