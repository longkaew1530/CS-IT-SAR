<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category3_infostudent_qty extends Model
{
    protected $table = 'category3-infostundent-qty';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id','year_id','course_id','qty'
    ];
    public $timestamps = false;
}
