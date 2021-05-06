<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category7_strengths_summary extends Model
{
    protected $table = 'category7-strengths_summary';
    protected $primaryKey = 'id';
    protected $fillable=[
        'strength','points_development','development_approach','year_id','course_id','composition_id','branch_id'
    ];
    public $timestamps = false;
    public function composition()
    {
        return $this->hasMany('App\composition','composition_id');
    }
}
