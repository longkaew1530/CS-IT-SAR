<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'm_id';
    protected $fillable=[
        'm_id','m_Name'
    ];
    public function groupmenu()
    {
        return $this->belongsTo('App\Groupmenu','m_id');
    }
}
