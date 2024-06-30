<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoOutputRequest extends FormRequest
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
            // 'uuid' => ['exists:penelitian,uuid'],
            'jenis_output_id' => ['required', 'exists:jenis_output,id'],
            'judul_output' => ['required', 'string', 'max:255'],
            'status_output_id' => ['required', 'exists:status_output,id'],
            'tautan' => [
                'nullable',
                'regex:/^https?:\/\/[^\s$.?#].[^\s]*$/i',
            ],
            'user_id_video_*' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
