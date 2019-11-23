<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AngketPeminatanSiswa extends Model
{
	use SoftDeletes;

	protected $table = "angket_peminatan";

	protected $dates = [
	    'deleted_at'
	    ];
	    
	protected $fillable = [
	    'nilai',
	    'id_kriteria',
	    'id_user'
	    ];
}
