<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'id_siswa',
        'id_guru',
        'status_kehadiran',
        'alasan',
        'tangga_absensil'
    ];

    public function siswa(): belongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function guru(): belongsTo
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
