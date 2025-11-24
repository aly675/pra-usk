<?php

namespace App\Models;

use App\Models\Absensi;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'nama',
        'nip',
        'password',
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_guru');
    }
}
