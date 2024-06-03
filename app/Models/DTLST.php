<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DTLST extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dtlst';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis_dtlst_id',
        'sub_jenis_dtlst_id',
        'judul',
        'tanggal',
        'uraian',
        'file_gambar_dtlst',
        'file_uraian_dtlst',
        'file_surat_pernyataan_kepemilikan',
        'file_surat_pernyataan_pengalihan_hak',
        'file_sertifikat',
        'link_sertifikat',
        'status',
        'pesan'
    ];

    public function jenisDTLST(): BelongsTo
    {
        return $this->belongsTo(JenisDTLST::class);
    }

    public function subJenisDTLST(): BelongsTo
    {
        return $this->belongsTo(SubJenisDTLST::class);
    }

    public function pengusul(): HasMany
    {
        return $this->hasMany(Pengusul::class);
    }
}
