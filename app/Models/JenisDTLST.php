<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisDTLST extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jenis_dtlst';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
    ];

    public function DTLST(): HasMany
    {
        return $this->hasMany(DTLST::class);
    }

    public function subJenisDTLST(): HasMany
    {
        return $this->hasMany(SubJenisDTLST::class);
    }
}
