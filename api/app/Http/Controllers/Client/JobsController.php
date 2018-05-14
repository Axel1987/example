<?php

namespace App\Http\Controllers\Client;

use App\Contract\JobsInterface;
use App\Http\Controllers\Controller;
use App\Http\Request\Client\JobRequest;
use App\Job;
use App\Service\JobsService;

class JobsController extends Controller
{
    /** @var  JobsService $jobService */
    protected $jobService;

    /**
     * JobsController constructor.
     */
    public function __construct()
    {
        $this->jobService = app()->make(JobsInterface::class);
    }

    /**
     * @SWG\Get(
     *     tags={"CLIENT:: Jobs methods"},
     *     path="/client/jobs",
     *     summary="Get list of jobs with pagination",
     *     description="Get list of jobs with pagination",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="page",
     *          type="integer",
     *          in="query",
     *          required=true,
     *          default="1"
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="Jobs array"
     *     )
     * )
     */
    /**
     * @return mixed
     */
    public function index()
    {
        return $this->jobService->index();
    }

    /**
     * @SWG\Get(
     *     tags={"CLIENT:: Jobs methods"},
     *     path="/client/jobs/{id}",
     *     summary="View job data",
     *     description="View job data",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="id",
     *          type="integer",
     *          in="path",
     *          required=true
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="Job data"
     *     )
     * )
     */
    /**
     * @param Job $job
     * @return mixed
     */
    public function view(Job $job)
    {
        return $this->jobService->view($job);
    }

    /**
     * @SWG\Post(
     *     tags={"CLIENT:: Jobs methods"},
     *     path="/client/jobs",
     *     summary="Add new job",
     *     description="Add new job",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          description="Job's data",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="client_id", type="integer", default="" ),
     *              @SWG\Property(property="description", type="string", default="" )
     *          ),
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="Job's data"
     *     )
     * )
     */
    /**
     * @param JobRequest $request
     * @return mixed
     */
    public function create(JobRequest $request)
    {
        return $this->jobService->create($request);
    }

    /**
     * @SWG\Put(
     *     tags={"CLIENT:: Jobs methods"},
     *     path="/client/jobs/{id}",
     *     summary="Edit the job",
     *     description="Edit the job",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="id",
     *          in="path",
     *          type="integer",
     *          description="Number of job",
     *          default="",
     *          required=true
     *     ),
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          description="Job's data",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="client_id", type="integer", default="" ),
     *              @SWG\Property(property="description", type="string", default="" ),
     *              @SWG\Property(property="active", type="integer", default="0" ),
     *              @SWG\Property(property="completed", type="integer", default="0" )
     *          ),
     *     ),
     *     @SWG\Response(
     *      response="200",
     *      description="Job's data"
     *     )
     * )
     */
    /**
     * @param Job $job
     * @param JobRequest $request
     * @return mixed
     */
    public function edit(Job $job, JobRequest $request)
    {
        return $this->jobService->edit($job, $request);
    }
}