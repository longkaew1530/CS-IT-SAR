<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category4_newteacher extends Model
{
    protected $table = 'category4-teacher_orientation';
    protected $primaryKey = 'id';
    protected $fillable=[
        'point_out','new_teacher_qty','teacher_point_out_qty','branch_id'
    ];
    public $timestamps = false;
}
