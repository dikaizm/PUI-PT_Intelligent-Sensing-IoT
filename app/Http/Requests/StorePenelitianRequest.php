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
            // 'skema_id' => ['required', 'exists:skema,id'],
            'judul' => ['required', 'string', 'max:255'],
            'tingkatan_tkt' => ['required', 'integer', 'between:1,9'],
            'pendanaan' => ['required', 'integer', 'min:0'],
            'waktu_mulai' => ['required', 'date_format:Y-m-d'],
            'waktu_akhir' => ['nullable', 'date_format:Y-m-d', 'after:waktu_mulai'],
            'jangka_waktu' => ['nullable', 'numeric', 'min:1'],
            // 'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'link_penelitian' => ['nullable', 'url'],
            'status_penelitian_id' => [
                'required',
                'exists:status_penelitian,id',
            ],
            // 'jenis_penelitian_id' => ['required', 'exists:jenis_penelitian,id'],
            'mitra' => ['nullable', 'string', 'max:64'],
            'user_id_*' => ['required', 'integer', 'exists:users,id'],
            'is_ketua' => ['required', 'exists:users,id'],
            'arsip' => ['nullable', 'boolean'],
            'skema_lainnya' => ['nullable', 'string', 'max:255'],
            'jenisPenelitian_lainnya' => ['nullable', 'string', 'max:255'],
        ];
    }
}
