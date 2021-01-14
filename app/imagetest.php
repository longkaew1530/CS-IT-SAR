<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class imagetest extends Model
{
    protected $table = 'testimage';
    protected $primaryKey = 'id';
    protected $fillable=[
        'image'
    ];
}
