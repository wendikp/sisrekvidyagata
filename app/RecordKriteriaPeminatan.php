<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordKriteriaPeminatan extends Model
{
    use SoftDeletes;

	protected $table = "record_kriteria_peminatan";

	protected $dates = [
	    'deleted_at'
	    ];
	    
	protected $fillable = [
	    'id_kriteria_peminatan',
	    'angkatan'
	    ];
}
