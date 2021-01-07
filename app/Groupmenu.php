<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupmenu extends Model
{
    protected $table = 'menu_group';
    protected $primaryKey = 'g_id';
    protected $fillable=[
        'g_id','g_Name','g_icon'
    ];
    public function menu()
    {
        return $this->hasMany('App\Menu','g_id','g_id');
    }
    public $timestamps = false;
}
