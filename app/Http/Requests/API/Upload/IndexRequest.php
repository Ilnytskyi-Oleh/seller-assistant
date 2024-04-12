<?php

namespace App\Http\Requests\API\Upload;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => ['file', 'required', 'mimes:csv,txt'],
            'uuid' => ['required', 'string'],
            'start' => ['nullable', 'numeric'],
            'size' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'The file field is required.',
            'uuid.required' => 'The uuid field is required.',
            'file.mimes' => 'The file must be a file of type: csv.',
        ];
    }
}
