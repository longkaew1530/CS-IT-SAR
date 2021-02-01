<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category7_newstrength extends Model
{
    protected $table = 'category7-newstrength';
    protected $primaryKey = 'id';
    protected $fillable=[
        'composition','strength','should_develop'
    ];
    public $timestamps = false;
}
