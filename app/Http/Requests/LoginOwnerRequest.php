<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginOwnerRequest extends FormRequest
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
            'phone' => 'required|numeric',
            'password' => 'required|min:8',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'message' => 'Error',
            'errors' => $validator->errors()],
            422);
        throw new ValidationException($validator,$response);
    }
}
