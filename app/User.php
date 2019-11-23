<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// tambahan untuk soft delete
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    // tambahan untuk soft delete
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // tambahan untuk soft delete
    protected $dates = ['deleted_at'];

    protected $fillable = [
        // 'name', 'email', 'password',
        'no_induk', 
        'name', 
        'password', 
        'email', 
        'no_telepon',
        'alamat',
        'jenis_kelamin',
        'tgl_lahir', 
        'angkatan',
        'asal_sekolah',   
        'role',
        'periode',
        'temp_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
