<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HakCiptaUpdateRequest extends FormRequest
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
            'jenis_hak_cipta_id' => 'required|numeric|min:1',
            'sub_jenis_hak_cipta_id' => 'required|numeric|min:1',
            'judul' => 'required|string',
            'tanggal' => 'required|date',
            'uraian' => 'required|string',
            'negara_id' => 'required|numeric|min:1',
            'kota_id' => 'required|numeric|min:1',
            'link_sertifikat' => 'string',
            'file_permohonan' => 'mimes:pdf',
            'file_pengalihan' => 'mimes:pdf',
            'file_pernyataan' => 'mimes:pdf',
            'file_ktp' => 'mimes:pdf',
            'tipe' => 'array',
            'nama' => 'array',
            'nip' => 'array',
            'hp' => 'array'
        ];
    }
}
