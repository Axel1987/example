<?php

namespace App\Contract;

use App\Http\Request\Admin\CreatePartnerCandidateRequest;
use App\Http\Request\Admin\EditPartnerCandidateRequest;
use App\PartnerCandidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

interface PartnerCandidateInterface
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
     * @param PartnerCandidate $candidate
     * @param EditPartnerCandidateRequest $request
     * @param null $link
     * @return mixed
     */
    public function edit(PartnerCandidate $candidate, EditPartnerCandidateRequest $request, $link = null);
}