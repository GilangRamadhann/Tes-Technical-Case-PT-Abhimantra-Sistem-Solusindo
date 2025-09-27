<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $fillable = ['siswa_id', 'kelas', 'mapel', 'nilai'];

    public function siswa(): BelongsTo {
        return $this->belongsTo(Siswa::class);
    }
}
