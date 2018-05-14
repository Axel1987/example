<?php

namespace App\Service;

use App\Contract\PartnerCandidateInterface;
use App\Http\Request\Admin\CreatePartnerCandidateRequest;
use App\Http\Request\Admin\EditPartnerCandidateRequest;
use App\PartnerCandidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PartnerCandidateService implements PartnerCandidateInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return PartnerCandidate::orderBy('id')
            ->paginate(10);
    }

    /**
     * Add the new candidate in the system
     *
     * @param FormRequest $request
     * @param $link
     * @return mixed
     */
    public  function create(FormRequest $request, $link)
    {
        $candidate = new PartnerCandidate($request->all());
        $candidate->resume = $link;
        $candidate->save();
        
        return PartnerCandidate::where(['id' => $candidate->id])
            ->first();
    }

    /**
     * Edit candidate's record
     *
     * @param PartnerCandidate $candidate
     * @param EditPartnerCandidateRequest $request
     * @param null $link
     * @return mixed
     */
    public function edit(PartnerCandidate $candidate, EditPartnerCandidateRequest $request, $link = null)
    {
        $data = $request->all();
        if($link){
            $data['resume'] = $link;
        }

        $candidate->update($data);

        return PartnerCandidate::where(['id' => $candidate->id])
            ->first();
    }
}