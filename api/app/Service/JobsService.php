<?php

namespace App\Service;

use App\Contract\JobsInterface;
use App\Http\Request\Admin\JobRequest;
use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Job;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class JobsService implements JobsInterface
{    
    /** @var User $user */
    protected $user;
    
    public function __construct()
    {
        /** @var User $user */
        $this->user = Auth::user();
    }

    /**
     * Get list of jobs with pagination
     *
     * @return mixed
     */
    public function index()
    {
        $query = Job::orderBy('id');

        switch ($this->user->userRole->role->name) {
            case Role::ROLE_ADMIN:
                $query->with(['client', 'partner.rating']);
                break;
            case Role::ROLE_PARTNER:
                $query->with('client', 'partner.rating')
                    ->where(['assigned' => $this->user->id]);
                break;
            case Role::ROLE_CLIENT:
                $query->with('partner.rating')
                    ->where(['client_id' => $this->user->id]);
                break;
            default:
                throw new UnprocessableEntityHttpException('Unknown user');
        }
        
        return $query->paginate(10);
    }

    /**
     * View record of Job
     * 
     * @param Job $job
     * @return mixed
     */
    public function view(Job $job)
    {
        $query = Job::where(['id' => $job->id]);

        switch ($this->user->userRole->role->name) {
            case Role::ROLE_ADMIN:
                $query->with('partner.rating', 'client');
                break;
            case Role::ROLE_PARTNER:
                $query->with('client')
                    ->where(['assigned' => $this->user->id]);
                break;
            case Role::ROLE_CLIENT:
                $query->with('partner.rating')
                    ->where(['client_id' => $this->user->id]);
                break;
            default:
                throw new UnprocessableEntityHttpException('Unknown user');
        }
        
        return $query->first();
    }

    /**
     * Create a new request for job
     *
     * @param FormRequest $request
     * @return mixed
     */
    public function create(FormRequest $request)
    {
        $job = new Job($request->all());
        $job->save();

        return $this->view($job);
    }

    /**
     * Update the record for job
     *
     * @param Job $job
     * @param FormRequest $request
     * @return mixed
     */
    public function edit(Job $job, FormRequest $request)
    {
        $job->update($request->all());

        return $this->view($job);
    }
}