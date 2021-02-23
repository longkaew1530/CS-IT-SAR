<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instructor extends Model
{
    protected $table = 'instructor';
    protected $primaryKey = 'user_id';
    protected $fillable=[
        'user_id','year_id','course_id'
    ];
    public $timestamps = false;
}
