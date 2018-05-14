<?php

namespace App\Http\Controllers\Admin;

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
     *     tags={"ADMIN:: Job's methods"},
     *     path="/admin/jobs",
     *     summary="Get list of jobs with pagination",
     *     description="Get list of jobs with pagination",
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

    /**
     * @SWG\Post(
     *     tags={"ADMIN:: Job's methods"},
     *     path="/admin/jobs",
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
     *              @SWG\Property(property="description", type="string", default="" ),
     *              @SWG\Property(property="active", type="integer", default="0" ),
     *              @SWG\Property(property="completed", type="integer", default="0" ),
     *              @SWG\Property(property="assigned", type="integer", default="", description="Talent ids; nullable" ),
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
        return $this->jobsService->create($request);
    }

    /**
     * @SWG\Put(
     *     tags={"ADMIN:: Job's methods"},
     *     path="/admin/jobs/{id}",
     *     summary="Edit the job",
     *     description="Edit the job",
     *     produces={"application/json"},
     *     security={{"Bearer":{}}},
     *     @SWG\Parameter(
     *          name="jobId",
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
     *              @SWG\Property(property="completed", type="integer", default="0" ),
     *              @SWG\Property(property="assigned", type="integer", default="", description="Talent ids; nullable" ),
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
        return $this->jobsService->edit($job, $request);
    }
}