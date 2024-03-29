<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_teacher extends Model
{
    protected $table = 'course_teacher';
    protected $primaryKey = 'user_id';
    protected $fillable=[
        'user_id','year_id','course_id','branch_id','status'
    ];
    public $timestamps = false;
}
