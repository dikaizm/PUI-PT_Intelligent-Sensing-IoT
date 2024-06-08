<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHkiOutputRequest extends FormRequest
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
            'jenis_output_id' => ['required', 'exists:jenis_output,id'],
            'status_output_id' => ['required', 'exists:status_output,id'],
            'judul_penelitian' => ['required', 'max:254'],
            'judul_output' => ['required', 'max:254'],
            'tautan' => ['nullable', 'regex:/^https?:\/\/.*/i'],
        ];
    }
}
