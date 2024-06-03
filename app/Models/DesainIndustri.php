<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DesainIndustri extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'desain_industri';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis_desain_industri_id',
        'sub_jenis_desain_industri_id',
        'judul',
        'tanggal',
        'uraian',
        'file_gambar_desain_industri',
        'file_rincian_gambar_desain_industri',
        'file_gambar_tampak_depan',
        'file_gambar_tampak_belakang',
        'file_gambar_tampak_samping_kiri',
        'file_gambar_tampak_samping_kanan',
        'file_gambar_tampak_atas',
        'file_uraian_desain_industri',
        'file_surat_pernyataan_kepemilikan',
        'file_surat_pernyataan_pengalihan_hak',
        'file_sertifikat',
        'link_sertifikat',
        'status',
        'pesan'
    ];

    public function jenisHakCipta(): BelongsTo
    {
        return $this->belongsTo(JenisHakCipta::class);
    }

    public function subJenisHakCipta(): BelongsTo
    {
        return $this->belongsTo(SubJenisHakCipta::class);
    }

    public function negara(): BelongsTo
    {
        return $this->belongsTo(Negara::class);
    }

    public function kota(): BelongsTo
    {
        return $this->belongsTo(Kota::class);
    }

    public function pengusul(): HasMany
    {
        return $this->hasMany(Pengusul::class);
    }
}
