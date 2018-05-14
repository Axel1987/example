<?php

namespace App\Http\Controllers\Talent;

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
     *     tags={"TALENT:: Partner-candidate's methods"},
     *     path="/talent/partner-candidates",
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
     *      description="Candidate's data"
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
}