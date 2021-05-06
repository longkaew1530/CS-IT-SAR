<?php

namespace App\ModelAJ;

use Illuminate\Database\Eloquent\Model;

class category4_incomplete_content extends Model
{
    protected $table = 'category4-incomplete_content';
    protected $primaryKey = 'id';
    protected $fillable=[
        'code_name','term','topic','untraceable','plan_update','branch_id'
    ];
    public $timestamps = false;
}
