<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_permission extends Model
{
    protected $table = 'user_permission';
    protected $primaryKey = 'user_id';
    protected $fillable=[
        'user_id','g_id','m_id','year_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
