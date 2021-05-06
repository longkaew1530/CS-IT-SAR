<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category4_notcourse_results extends Model
{
    protected $table = 'category4-not_offered';
    protected $primaryKey = 'id';
    protected $fillable=[
        'code_name','term','description','measure','branch_id'
    ];
    public $timestamps = false;
}
