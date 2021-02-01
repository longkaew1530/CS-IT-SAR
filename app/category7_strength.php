<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category7_strength extends Model
{
    protected $table = 'category7-strength';
    protected $primaryKey = 'id';
    protected $fillable=[
        'composition','strength','should_develop','development_approach','year_id','course_id'
    ];
    public $timestamps = false;
}
