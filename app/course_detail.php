<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_detail extends Model
{
    protected $table = 'course_detail';
    protected $primaryKey = 'course_id';
    protected $fillable=[
        'course_id','name','background','branch_id','academic_position'
    ];
    public $timestamps = false;
    public function course()
    {
        return $this->belongsTo('App\Course','course_id');
    }
}
