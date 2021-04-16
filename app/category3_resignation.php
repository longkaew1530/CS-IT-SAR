<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category3_resignation extends Model
{
    protected $table = 'category3-resignation';
    protected $primaryKey = 'id';
    protected $fillable=[
        'year_add','qty','course_id','year_present'
    ];
    public $timestamps = false;
}
