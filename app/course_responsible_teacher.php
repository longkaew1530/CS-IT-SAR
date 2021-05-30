<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_responsible_teacher extends Model
{
    protected $table = 'course_responsible_teacher';
    protected $fillable=[
        'user_id','year_id','course_id','branch_id','status'
    ];
    public $timestamps = false;
}
