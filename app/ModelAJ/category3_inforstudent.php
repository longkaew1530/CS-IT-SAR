<?php

namespace App\ModelAJ;

use Illuminate\Database\Eloquent\Model;

class category3_inforstudent extends Model
{
    protected $table = 'test1';
    protected $primaryKey = 'id';
    protected $fillable=[
        'y1','y2','y3','y4','y5','y6','y7','yearadd'
    ];
    public $timestamps = false;
}
