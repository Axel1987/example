<?php

namespace App\Http\Controllers\Talent;

use App\Candidate;
use App\Contract\CandidateInterface;
use App\Http\Controllers\Controller;
use App\Http\Request\Admin\CreatePartnerCandidateRequest;
use App\Http\Request\Admin\EditCandidateRequest;
use App\Service\CandidateService;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /** @var CandidateService $candidateService */
    protected $candidateService;

    /**
     * CandidateController constructor.
     */
    public function __construct()
    {
        $this->candidateService = app()->make(CandidateInterface::class);
    }

    /**
     * @SWG\Get(
     *     tags={"TALENT:: Candidate's methods"},
     *     path="/talent/candidates",
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
}