<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rolepermission extends Model
{
    protected $table = 'role_permission';
    protected $primaryKey = 'user_group_id';
    protected $fillable=[
        'user_group_id','g_id','m_id'
    ];
}
