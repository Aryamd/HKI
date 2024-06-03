<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengusul extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengusul';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hak_cipta_id',
        'paten_id',
        'merek_id',
        'desain_industri_id',
        'dtlst_id',
        'nip',
        'nrp',
        'nama',
        'email',
        'hp',
        'is_ketua',
        'is_doskar',
        'is_mahasiswa',
        'is_eksternal',
        'doskar_id',
        'mahasiswa_id',
        'urutan'
    ];

    public function hakCipta(): BelongsTo
    {
        return $this->belongsTo(HakCipta::class);
    }
}
