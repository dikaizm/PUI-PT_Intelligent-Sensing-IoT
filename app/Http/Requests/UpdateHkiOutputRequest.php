<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHkiOutputRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul_output' => ['required', 'string', 'max:255'],
            'status_output_id' => ['required', 'exists:status_output,id'],
            'published_at' => ['nullable', 'date'],
            'tautan' => [
                'nullable',
                'regex:/^https?:\/\/[^\s$.?#].[^\s]*$/i',
                'max:255',
            ],
        ];
    }
}
