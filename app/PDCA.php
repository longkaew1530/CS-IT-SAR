<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PDCA extends Model
{
    protected $table = 'roles';
    protected $fillable=[
        'name'
    ];
     protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
