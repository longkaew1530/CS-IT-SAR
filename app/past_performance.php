<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class past_performance extends Model
{
    protected $table = 'past_performance';
    protected $primaryKey = 'm_id';
    protected $fillable=[
        'teacher_name','work_name','detail','year'
    ];

    public $timestamps = false;
}
