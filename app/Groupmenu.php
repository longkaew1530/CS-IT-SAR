<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupmenu extends Model
{
    protected $table = 'groupmenu';
    protected $primaryKey = 'G_Id';
    protected $fillable=[
        'G_Id','G_Name'
    ];
    public function menu()
    {
        return $this->hasMany('App\Menu');
    }
}
