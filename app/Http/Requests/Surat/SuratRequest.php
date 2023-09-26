<?php

namespace App\Http\Requests\Surat;

use Illuminate\Foundation\Http\FormRequest;

class SuratRequest extends FormRequest
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
            'id_jenis_surat' => 'required',
            'tanggal_surat'  => 'required',
            'ringkasan'      => 'required',
            'id_user'        => 'required',
            'file'           => 'nullable|mimes:pdf',
        ];
    }
    public function attributes()
    {
        return [
            'id_jenis_surat' => 'Jenis surat',
            'id_user'        => 'User'
        ];
    }
    public function messages(): array
    {
        return [
            'required' => ":Attribute tidak boleh kosong",
            'mimes'    => ":Attribute bukan pdf"
        ];
    }
}