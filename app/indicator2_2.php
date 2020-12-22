<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicator2_2 extends Model
{
    protected $table = 'indicator2_2';
    protected $primaryKey = 'id';
    protected $fillable=[
        'total','answer','job','straight_line','not_straight_line','freelance','before'
        ,'continue_study','ordain','soldier','unemployed'
    ];
}
