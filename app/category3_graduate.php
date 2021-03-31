<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category3_graduate extends Model
{
    protected $table = 'category3-graduate';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id','year_add','reported_year','year_id','course_id','reported_year_qty'
    ];
    public $timestamps = false;
}
