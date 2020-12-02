<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'M_Id';
    protected $fillable=[
        'M_Id','M_Name'
    ];
    public function groupmenu()
    {
        return $this->belongsTo('App\Groupmenu','M_Id');
    }
}
