<?php

namespace App\Contract;

use App\Candidate;
use App\Http\Request\Admin\EditCandidateRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

interface CandidateInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request);

    /**
     * Add the new candidate in the system
     *
     * @param FormRequest $request
     * @param $link
     * @return mixed
     */
    public  function create(FormRequest $request, $link);

    /**
     * Edit candidate's record
     *
     * @param Candidate $candidate
     * @param EditCandidateRequest $request
     * @param null $link
     * @return mixed
     */
    public function edit(Candidate $candidate, EditCandidateRequest $request, $link);
}