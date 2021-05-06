<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category4_teaching_quality extends Model
{
    protected $table = 'category4-teaching_quality';
    protected $primaryKey = 'id';
    protected $fillable=[
        'student_year','stu_year_of_admission','course_code','course_name','course_year','term','status','description','branch_id'
    ];
}
