<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category4_activity extends Model
{
    protected $table = 'category4-activity';
    protected $primaryKey = 'id';
    protected $fillable=[
        'organized_activities','status','comment'
    ];
    public $timestamps = false;
}
