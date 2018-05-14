<?php

namespace App\Http\Request\Client;

use Illuminate\Foundation\Http\FormRequest;

class EditReviewRequest extends FormRequest
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
            'client_id' => 'required|integer|exists:users,id',
            'talent_id' => 'required|integer|exists:users,id',
            'job_id' => 'required|integer|exists:jobs,id',
            'rating' => 'required|integer',
            'text' => 'required|string|min:16',
            'status' => 'required:boolean'
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