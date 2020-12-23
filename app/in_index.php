<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class in_index extends Model
{
    protected $table = 'indicator_index';
    protected $primaryKey = 'id';
    protected $fillable=[
        'name'
    ];
    
}
