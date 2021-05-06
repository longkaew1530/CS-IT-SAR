<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class year_acceptance_graduate extends Model
{
    protected $table = 'year_acceptance_graduate';
    protected $primaryKey = 'year_id';
    protected $fillable=[
        'id','year_add','reported_year','year_id','course_id','branch_id'
    ];
    public $timestamps = false;
}
