<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubJenisDTLST extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sub_jenis_dtlst';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'jenis_dtlst_id'
    ];

    public function DTLST(): HasMany
    {
        return $this->hasMany(DTLST::class);
    }

    public function jenisDTLST(): BelongsTo
    {
        return $this->belongsTo(JenisDTLST::class);
    }
}
