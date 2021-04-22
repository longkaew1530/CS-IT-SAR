<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class past_performance_user extends Model
{
    protected $table = 'past_performance_user';
    protected $primaryKey = 'm_id';
    protected $fillable=[
        'past_performance_past_performance_id','user_id'
    ];

    public $timestamps = false;
}
