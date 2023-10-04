<?php

namespace App\Http\Requests\JenisSurat;

use App\Models\JenisSurat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class JenisSuratRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'jenis_surat' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'jenis_surat.required' => 'Jenis surat tidak boleh kosong',
        ];
    }
    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (JenisSurat::where('jenis_surat', $this->jenis_surat)->count() >= 1) {
                    $validator->errors()->add(
                        'jenis_surat',
                        "Jenis surat $this->jenis_surat already exists"
                    );
                }
            }
        ];
    }
}