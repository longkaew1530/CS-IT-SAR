<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class defaulindicator extends Model
{
    protected $table = 'defaulindicator';
    protected $primaryKey = 'id';
    protected $fillable=[
        'Indicator_id','Indicator_name','category_id','composition_id','url'
    ];
    public $timestamps = false;
}
