<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubJenisHakCipta extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sub_jenis_hak_cipta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'jenis_hak_cipta_id'
    ];

    public function hakCipta(): HasMany
    {
        return $this->hasMany(HakCipta::class);
    }

    public function jenisHakCipta(): BelongsTo
    {
        return $this->belongsTo(JenisHakCipta::class);
    }
}
