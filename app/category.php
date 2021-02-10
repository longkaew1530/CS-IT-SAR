<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $fillable=[
        'category_name','category_year_id'
    ];
    public $timestamps = false;
}
