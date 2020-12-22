<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category4_notcourse_results extends Model
{
    protected $table = 'category4-not_offered';
    protected $primaryKey = 'id';
    protected $fillable=[
        'course_code','course_name','term','course_year','description','measure'
    ];
}
