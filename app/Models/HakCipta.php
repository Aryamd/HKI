<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HakCipta extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hak_cipta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis_hak_cipta_id',
        'sub_jenis_hak_cipta_id',
        'judul',
        'tanggal',
        'uraian',
        'negara_id',
        'kota_id',
        'file_permohonan',
        'file_pengalihan',
        'file_pernyataan',
        'file_ktp',
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
