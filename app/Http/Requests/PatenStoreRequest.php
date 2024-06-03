<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatenStoreRequest extends FormRequest
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
            'file_pernyataan_kebaruan' => 'required|mimes:pdf',
            'file_permohonan_paten' => 'required|mimes:pdf',
            'file_pemeriksaan_substantif' => 'required|mimes:pdf',
            'file_deskripsi_paten' => 'required|mimes:pdf',
            'file_klaim' => 'required|mimes:pdf',
            'file_gambar_teknik' => 'required|mimes:pdf',
            'file_abstrak' => 'required|mimes:pdf',
            'file_penyerahan_hak' => 'required|mimes:pdf',
            'file_kepemilikan_inventor' => 'required|mimes:pdf',
            'file_surat_pengalihan_hak' => 'required_if:jenis_paten_id,2|mimes:pdf',
            'tipe' => 'array',
            'nama' => 'array',
            'nip' => 'array',
            'hp' => 'array'
        ];
    }
}
