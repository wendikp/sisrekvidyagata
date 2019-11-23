<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Rombel extends Model
{
	use softDeletes;
	
	protected $table = "rombel";
	protected $dates = ['deleted_at'];
	protected $fillable = [
	    'nama_rombel',
	    'wali_kelas',
	    'jumlah_siswa',
	    'kuota_kelas',
	    'peminatan',
	    'tahun_ajar'
	];
}
