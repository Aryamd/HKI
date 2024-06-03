<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatenUpdateRequest extends FormRequest
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
            'jenis_paten_id' => 'required|numeric|min:1',
            // 'status_paten_id' => 'required|numeric|min:1',
            'judul' => 'required|string',
            // 'tanggal' => 'required|date',
            'abstrak' => 'required|string',
            'file_pernyataan_kebaruan' => 'mimes:pdf',
            'file_permohonan_paten' => 'mimes:pdf',
            'file_pemeriksaan_substantif' => 'mimes:pdf',
            'file_deskripsi_paten' => 'mimes:pdf',
            'file_klaim' => 'mimes:pdf',
            'file_gambar_teknik' => 'mimes:pdf',
            'file_abstrak' => 'mimes:pdf',
            'file_penyerahan_hak' => 'mimes:pdf',
            'file_kepemilikan_inventor' => 'mimes:pdf',
            'file_surat_pengalihan_hak' => 'mimes:pdf',
            'tipe' => 'array',
            'nama' => 'array',
            'nip' => 'array',
            'hp' => 'array'
        ];
    }
}
