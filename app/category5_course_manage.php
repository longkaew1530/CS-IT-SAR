<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category5_course_manage extends Model
{
    protected $table = 'category5-course_manage';
    protected $primaryKey = 'id';
    protected $fillable=[
        'problem','effect','solution'
    ];
    public $timestamps = false;
}
