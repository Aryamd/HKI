<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paten extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paten';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis_paten_id',
        'status_paten_id',
        'judul',
        'tanggal',
        'abstrak',
        'file_pernyataan_kebaruan',
        'file_permohonan_paten',
        'file_pemeriksaan_substantif',
        'file_deskripsi_paten',
        'file_klaim',
        'file_gambar_teknik',
        'file_abstrak',
        'file_penyerahan_hak',
        'file_kepemilikan_inventor',
        'file_surat_pengalihan_hak',
        'file_sertifikat',
        'link_sertifikat',
    ];

    public function jenisPaten(): BelongsTo
    {
        return $this->belongsTo(JenisPaten::class);
    }

    public function statusPaten(): BelongsTo
    {
        return $this->belongsTo(StatusPaten::class);
    }

    public function pengusul(): HasMany
    {
        return $this->hasMany(Pengusul::class);
    }
}
