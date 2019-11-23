<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// tambahan untuk soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class KriteriaPeminatan extends Model
{
    // tambahan untuk soft delete
    use SoftDeletes;

    protected $table = "kriteria_peminatan";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'kode_kriteria',
        'jumlah',
        'status',
        'status_bobot'
    ];
}
