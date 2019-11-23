<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class SoalPsikotest extends Model
{
    use softDeletes;

    protected $table = "soal_psikotest";
	protected $dates = ['deleted_at'];
	protected $fillable = [
	    'soal',
	    'gambar',
	    'a',
	    'b',
	    'c',
	    'd',
	    'e',
	    'jawaban',
	    'id_psikotest'
	];
}
