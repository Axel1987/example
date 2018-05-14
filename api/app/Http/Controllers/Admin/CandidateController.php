<?php

namespace App\Http\Controllers\Admin;

use App\Candidate;
use App\Contract\CandidateInterface;
use App\Contract\UploadInterface;
use App\Http\Controllers\Controller;
use App\Http\Request\Admin\CreateCandidateRequest;
use App\Http\Request\Admin\EditCandidateRequest;
use App\Service\CandidateService;
use App\Service\UploadService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CandidateController extends Controller
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
     * @SWG\Get(
     *     tags={"ADMIN:: Candidate's methods"},
     *     path="/admin/candidates",
     *     summary="Get list of candidates with pagination",
     *     description="Get list of candidates with pagination",
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
        return $this->candidateService->index($request);
    }

    /**
     * @SWG\Post(
     *     tags={"ADMIN:: Candidate's methods"},
     *     path="/admin/candidates",
     *     summary="Add new candidate",
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
     * @param CreateCandidateRequest $request
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function create(CreateCandidateRequest $request)
    {
        /** @var UploadedFile $file */
        $file = $request->resume;
        
        $link = $this->uploadService->uploadResume($file);
        return $this->candidateService->create($request, $link);
    }

    /**
     * @SWG\Post(
     *     tags={"ADMIN:: Candidate's methods"},
     *     path="/admin/candidates/{id}",
     *     summary="Edit candidate",
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
     *      description="User's data"
     *     )
     * )
     */
    /**
     * @param Candidate $candidate
     * @param EditCandidateRequest $request
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function edit(Candidate $candidate, EditCandidateRequest $request)
    {
        /** @var UploadedFile $file */
        $file = $request->new_resume;

        if($file){
            $link = $this->uploadService->uploadResume($file);
        }else{
            $link = null;
        }
        
        return $this->candidateService->edit($candidate, $request, $link);
    }
}