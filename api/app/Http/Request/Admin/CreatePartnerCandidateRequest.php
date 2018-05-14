<?php

namespace App\Http\Request\Admin;


use Illuminate\Foundation\Http\FormRequest;

class CreatePartnerCandidateRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:partner_candidates',
            'phone' => 'required|numeric|unique:partner_candidates',
            'resume' => 'required|file',
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