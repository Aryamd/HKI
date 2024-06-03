<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisHakCipta extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jenis_hak_cipta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
    ];

    public function hakCipta(): HasMany
    {
        return $this->hasMany(HakCipta::class);
    }

    public function subJenisHakCipta(): HasMany
    {
        return $this->hasMany(SubJenisHakCipta::class);
    }
}
