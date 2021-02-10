<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'course_id';
    protected $fillable=[
        'course_name','faculty_id','course_code','update_course','place'
    ];
    public $timestamps = false;
}
