<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class composition extends Model
{
    protected $table = 'composition';
    protected $primaryKey = 'id';
    protected $fillable=[
        'name',
    ];
}
