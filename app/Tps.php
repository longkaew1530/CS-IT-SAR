<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    protected $table = 'tps';
    protected $primaryKey = 'Indicator_id';
    protected $fillable=[
        'target','performance','score'
    ];
}
