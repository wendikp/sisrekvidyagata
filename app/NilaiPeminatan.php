<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NilaiPeminatan extends Model
{
    use SoftDeletes;

	protected $table = "nilai_peminatan";

	protected $dates = [
	    'deleted_at'
	    ];
	    
	protected $fillable = [
	    'nilai_ipa',
	    'nilai_ips',
	    'nilai_bahasa',
	    'id_user'
	    ];
}
