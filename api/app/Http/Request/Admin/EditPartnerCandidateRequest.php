<?php

namespace App\Http\Request\Admin;


use Illuminate\Foundation\Http\FormRequest;

class EditPartnerCandidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currentId = $this->route('partnerCandidate')->id;

        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:partner_candidates,email,'. $currentId .',id',
            'phone' => 'required|numeric|unique:partner_candidates,phone,'. $currentId .',id',
            'resume' => 'required:string',
            'new_resume' => 'file',
        ];
    }

    /**
     * @param array $errors
     * @return mixed
     */
    public function response(array $errors)
    {
        response()->json(['status'=> 'error', 'data' => $errors], 422);
    }
}