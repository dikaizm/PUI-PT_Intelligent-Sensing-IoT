<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasRole('Admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:32'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'telp' => ['nullable', 'max:32', 'string'],
            'keahlian' => ['nullable', 'max:64', 'string'],
            'link_google_scholar' => ['nullable', 'max:255', 'string'],
            'link_sinta' => ['nullable', 'max:255', 'string'],
            'password' => ['nullable', 'string', 'confirmed', 'min:8'],
        ];
    }
}
