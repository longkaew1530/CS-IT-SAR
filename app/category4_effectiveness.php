<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category4_effectiveness extends Model
{
    protected $table = 'category4-effectiveness';
    protected $primaryKey = 'id';
    protected $fillable=[
        'learning_standards','comment','solution'
    ];
}
