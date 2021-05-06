<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category3_infostudent extends Model
{
    protected $table = 'category3-infostundent';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id','year_add','reported_year','year_id','course_id','reported_year_qty','branch_id'
    ];
    public $timestamps = false;
}
