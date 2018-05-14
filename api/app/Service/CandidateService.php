<?php

namespace App\Service;

use App\Candidate;
use App\Contract\CandidateInterface;
use App\Http\Request\Admin\CreateCandidateRequest;
use App\Http\Request\Admin\EditCandidateRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CandidateService implements CandidateInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return Candidate::orderBy('id')
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
        $candidate = new Candidate($request->all());
        $candidate->resume = $link;
        $candidate->save();
        
        return Candidate::where(['id' => $candidate->id])
            ->first();
    }

    /**
     * Edit candidate's record
     * 
     * @param Candidate $candidate
     * @param EditCandidateRequest $request
     * @param null $link
     * @return mixed
     */
    public function edit(Candidate $candidate, EditCandidateRequest $request, $link = null)
    {
        $data = $request->all();
        if($link){
            $data['resume'] = $link;
        }
        
        $candidate->update($data);

        return Candidate::where(['id' => $candidate->id])
            ->first();
    }
}