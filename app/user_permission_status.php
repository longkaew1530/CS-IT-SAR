<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_permission_status extends Model
{
    protected $table = 'user_permission_status';
    protected $primaryKey = 'id';
    protected $fillable=[
        'status1','status2','status3','status4','status5','status6','status7','status8','year_id','course_id','branch_id'
    ];

    public $timestamps = false;
}
