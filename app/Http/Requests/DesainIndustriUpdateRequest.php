<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesainIndustriUpdateRequest extends FormRequest
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
            'file_gambar_desain_industri' => 'mimes:pdf',
            'file_rincian_gambar_desain_industri' => 'mimes:pdf',
            'file_gambar_tampak_depan' => 'mimes:pdf',
            'file_gambar_tampak_belakang' => 'mimes:pdf',
            'file_gambar_tampak_samping_kiri' => 'mimes:pdf',
            'file_gambar_tampak_samping_kanan' => 'mimes:pdf',
            'file_gambar_tampak_atas' => 'mimes:pdf',
            'file_uraian_desain_industri' => 'mimes:pdf',
            'file_surat_pernyataan_kepemilikan' => 'mimes:pdf',
            'file_surat_pernyataan_pengalihan_hak' => 'mimes:pdf',
            'file_sertifikat' => 'mimes:pdf',
            'tipe' => 'array',
            'nama' => 'array',
            'nip' => 'array',
            'hp' => 'array'
        ];
    }
}
