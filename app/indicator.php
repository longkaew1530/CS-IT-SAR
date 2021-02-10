<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicator extends Model
{
    protected $table = 'indicator';
    protected $primaryKey = 'id';
    protected $fillable=[
        'Indicator_name'
    ];
    public $timestamps = false;
}
