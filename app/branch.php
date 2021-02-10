<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    protected $table = 'branch';
    protected $primaryKey = 'id';
    protected $fillable=[
        'name','course_id'
    ];
    public $timestamps = false;
}
