<?php

namespace App\Http\Request\Admin;


use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
        $currentId = $this->route('user')->id;

        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'. $currentId .',id',
            'phone' => 'required|numeric|unique:users,phone,'. $currentId .',id',
            'password' => 'string|min:8|confirmed',
            'password_confirmation' => 'string|min:8',
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