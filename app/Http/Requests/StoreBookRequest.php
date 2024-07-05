<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ApiResponse;

class StoreBookRequest extends FormRequest
{
    use ApiResponse;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'author.required' => 'The author is required.',
            'isbn.required' => 'The ISBN is required.',
            'isbn.unique' => 'The ISBN must be unique.',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException($this->validationErrorResponse($validator->errors()));
    }
}
