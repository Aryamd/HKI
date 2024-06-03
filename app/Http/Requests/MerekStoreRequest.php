<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerekStoreRequest extends FormRequest
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
            'jenis_merek_id' => 'required|numeric|min:1',
            // 'status_paten_id' => 'required|numeric|min:1',
            'judul' => 'required|string',
            // 'tanggal' => 'required|date',
            'uraian' => 'required|string',
            'file_uraian_merek' => 'required|mimes:pdf',
            'file_ttd_pemohon' => 'required|mimes:pdf',
            'file_gambar' => 'required|mimes:pdf',
            'file_pernyataan_lisensi' => 'required|mimes:pdf',
            'file_permohonan_merek' => 'required|mimes:pdf',
            'file_perpanjangan_merek' => 'mimes:pdf',
            'file_surat_pengalihan_hak' => 'required|mimes:pdf',
            'file_surat_perubahan_nama_alamat' => 'mimes:pdf',
            'file_penjelasan_pendaftaran_merek' => 'required|mimes:pdf',
            'file_penjelasan_perpanjangan_merek' => 'mimes:pdf',
            'file_penjelasan_pengalihan_hak' => 'required|mimes:pdf',
            'tipe' => 'array',
            'nama' => 'array',
            'nip' => 'array',
            'hp' => 'array'
        ];
    }
}
