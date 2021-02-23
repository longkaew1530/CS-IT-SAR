<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_permission extends Model
{
    protected $table = 'user_permission';
    protected $primaryKey = 'user_group_id';
    protected $fillable=[
        'user_id','g_id','m_id'
    ];
}
