<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekomendasiPeminatan extends Model
{
    use SoftDeletes;

	protected $table = "rekomendasi_peminatan";

	protected $dates = [
	    'deleted_at'
	    ];
	    
	protected $fillable = [
	    'rekomendasi_1',
	    'rekomendasi_2',
	    'rekomendasi_3',
	    'id_user'
	    ];
}
