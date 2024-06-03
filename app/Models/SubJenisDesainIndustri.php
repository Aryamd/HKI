<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubJenisDesainIndustri extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sub_jenis_desain_industri';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'jenis_desain_industri_id'
    ];

    // public function hakCipta(): HasMany
    // {
    //     return $this->hasMany(HakCipta::class);
    // }

    // public function jenisHakCipta(): BelongsTo
    // {
    //     return $this->belongsTo(JenisHakCipta::class);
    // }
}
