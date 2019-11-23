<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Psikotest extends Model
{
    use softDeletes;

    protected $table = "psikotest";
	protected $dates = ['deleted_at'];
	protected $fillable = [
	    'psikotest_code',
	    ];
}
