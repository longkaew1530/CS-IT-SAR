<?php

namespace App\ModelAJ;

use Illuminate\Database\Eloquent\Model;

class category4_academic_performance extends Model
{
    protected $table = 'category4-academic_performance';
    protected $primaryKey = 'id';
    protected $fillable=[
        'code_name','term','anomaly','tocheck','reason','plan_update','branch_id'
    ];
    public $timestamps = false;
}
