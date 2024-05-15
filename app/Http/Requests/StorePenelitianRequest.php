<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenelitianRequest extends FormRequest
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
            'skema' => ['required', 'string', 'max:128'],
            'judul' => ['required', 'string', 'max:255'],
            'tingkatan_tkt' => ['required', 'string', 'max:9', 'min:1'],
            'pendanaan' => ['numeric'],
            'jangka_waktu' => ['string|max:32'],
            'file' => ['file|mimes:pdf'],
            'feedback' => ['string|max:1000'],
            'status_penelitian_id' => ['required'],
            'jenis_penelitian' => ['required'],
            'mitra_id' => ['required'],
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'is_ketua' => 'required|array',
            'is_ketua.*' => 'boolean',
            'is_corresponding' => 'required|array',
            'is_corresponding.*' => 'boolean',
        ];
    }
}
