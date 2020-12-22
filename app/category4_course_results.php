<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category4_course_results extends Model
{
    protected $table = 'category4_course_results';
    protected $primaryKey = 'id';
    protected $fillable=[
        'course_code','course_name','term','year','a','b','BB','c','CC','d','DD','f','register','pass_exam'
    ];
}
