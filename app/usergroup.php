<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usergroup extends Model
{
    protected $table = 'user_group';
    protected $primaryKey = 'user_group_id';
    protected $fillable=[
        'user_group_name'
    ];
}
