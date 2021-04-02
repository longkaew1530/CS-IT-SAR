<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicator1_1 extends Model
{
    protected $table = 'indicator1_1';
    protected $primaryKey = 'id';
    protected $fillable=[
        'result1','result2','result3','result4','course_id','year_id'
    ];
    public $timestamps = false;
}
