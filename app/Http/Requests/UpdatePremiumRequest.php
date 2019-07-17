<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdatePremiumRequest extends FormRequest
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
            'name' => 'required',
            'discount' => 'numeric|required|max:100',
            'duration' => 'numeric|required|max:100'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'message' => 'Error',
            'errors' => $validator->errors()],
            422);
        throw new ValidationException($validator,$response);
    }
}
