<?php

namespace App\Contract;

use App\Http\Request\Admin\JobRequest;
use App\Job;
use Illuminate\Foundation\Http\FormRequest;

interface JobsInterface
{
    /**
     * Get list of jobs with pagination
     * 
     * @return mixed
     */
    public function index();

    /**
     * View record of Job
     *
     * @param Job $job
     * @return mixed
     */
    public function view(Job $job);

    /**
     * Create a new request for job
     *
     * @param FormRequest $request
     * @return mixed
     */
    public function create(FormRequest $request);

    /**
     * Update the record for job
     *
     * @param Job $job
     * @param FormRequest $request
     * @return mixed
     */
    public function edit(Job $job, FormRequest $request);
}