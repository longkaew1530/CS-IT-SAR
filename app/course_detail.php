<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_detail extends Model
{
    protected $table = 'course_detail';
    protected $primaryKey = 'course_id';
    protected $fillable=[
        'course_id','name','background'
    ];
    public $timestamps = false;
}
