<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'course_id';
    protected $fillable=[
        'course_name','faculty_id','course_code','update_course','place','initials'
    ];
    public $timestamps = false;
    public function course_detail()
    {
        return $this->hasMany('App\course_detail','course_id','course_id');
    }
    public function faculty()
    {
        return $this->belongsTo('App\Faculty','faculty_id');
    }
    public function branch()
    {
        return $this->hasMany('App\branch','course_id','course_id');
    }
}
