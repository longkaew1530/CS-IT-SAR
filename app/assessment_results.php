<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assessment_results extends Model
{
    protected $table = 'assessment_results';
    protected $primaryKey = 'id';
    protected $fillable=[
        'category_id','year_id'
    ];
    public $timestamps = false;
}
