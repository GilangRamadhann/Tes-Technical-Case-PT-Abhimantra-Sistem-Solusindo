<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $fillable = ['nama', 'kelas'];

    public function nilais(): HasMany {
        return $this->hasMany(Nilai::class);
    }
}
