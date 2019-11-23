<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// tambahan untuk soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class Kriteria extends Model
{
    // tambahan untuk soft delete
    use SoftDeletes;

    protected $table = "kriteria";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id_kriteria_peminatan',
        'kriteria',
        'bobot_prioritas_ipa',
        'bobot_prioritas_ips',
        'bobot_prioritas_bhs',
        'kategori',
        'klasifikasi_nilai'
    ];

    // protected $hidden = [
    //     'remember_token',
    // ];
}
