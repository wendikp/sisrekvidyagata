<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengumuman extends Model
{
    use SoftDeletes;

    protected $table = "pengumuman";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'judul',
        'isi',
        'id_user'
    ];
}
