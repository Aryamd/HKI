<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesainIndustriStoreRequest extends FormRequest
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
            'jenis_desain_industri_id' => 'required|numeric|min:1',
            'sub_jenis_desain_industri_id' => 'numeric|min:1',
            'judul' => 'required|string',
            'tanggal' => 'required|date',
            'uraian' => 'required|string',
            'link_sertifikat' => 'string',
            'file_gambar_desain_industri' => 'required|mimes:pdf',
            'file_rincian_gambar_desain_industri' => 'required|mimes:pdf',
            'file_gambar_tampak_depan' => 'required|mimes:pdf',
            'file_gambar_tampak_belakang' => 'required|mimes:pdf',
            'file_gambar_tampak_samping_kiri' => 'required|mimes:pdf',
            'file_gambar_tampak_samping_kanan' => 'required|mimes:pdf',
            'file_gambar_tampak_atas' => 'required|mimes:pdf',
            'file_uraian_desain_industri' => 'required|mimes:pdf',
            'file_surat_pernyataan_kepemilikan' => 'required|mimes:pdf',
            'file_surat_pernyataan_pengalihan_hak' => 'mimes:pdf',
            'file_sertifikat' => 'mimes:pdf',
            'pesan' => 'string',
            'tipe' => 'array',
            'nama' => 'array',
            'nip' => 'array',
            'hp' => 'array'
        ];
    }
}
