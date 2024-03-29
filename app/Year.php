<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table = 'year';
    protected $primaryKey = 'year_id';
    protected $fillable=[
        'year_name','date1','date2'
    ];
    public $timestamps = false;
}
