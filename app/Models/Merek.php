<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merek extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'merek';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis_merek_id',
        'judul',
        'tanggal',
        'uraian',
        'file_uraian_merek',
        'file_ttd_pemohon',
        'file_gambar',
        'file_pernyataan_lisensi',
        'file_permohonan_merek',
        'file_perpanjangan_merek',
        'file_surat_pengalihan_hak',
        'file_surat_perubahan_nama_alamat',
        'file_penjelasan_pendaftaran_merek',
        'file_penjelasan_perpanjangan_merek',
        'file_penjelasan_pengalihan_hak',
        'file_sertifikat',
        'link_sertifikat',
    ];

    public function jenisMerek(): BelongsTo
    {
        return $this->belongsTo(JenisMerek::class);
    }

    public function pengusul(): HasMany
    {
        return $this->hasMany(Pengusul::class);
    }
}
