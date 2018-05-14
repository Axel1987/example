<?php

namespace App\Http\Controllers\Talent;

use App\Contract\JobsInterface;
use App\Http\Controllers\Controller;
use App\Http\Request\Admin\JobRequest;
use App\Job;
use App\Service\JobsService;

class JobsController extends Controller
{
    /** @var  JobsService $jobsService */
    protected $jobsService;

    /**
     * JobsController constructor.
     */
    public function __construct()
    {
        $this->jobsService = app()->make(JobsInterface::class);
    }

    /**
     * @SWG\Get(
     *     tags={"TALENT:: Job's methods"},
     *     path="/talent/jobs",
     *     summary="Get list of talent's jobs with pagination",
     *     description="Get list of talent's jobs with pagination",
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
     *      description="Jobs data"
     *     )
     * )
     */
    /**
     * @return mixed
     */
    public function index()
    {
        return $this->jobsService->index();
    }
}