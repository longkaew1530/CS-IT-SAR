<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicator extends Model
{
    protected $table = 'indicator';
    protected $primaryKey = 'id';
    protected $fillable=[
        'Indicator_name'
    ];
    public function Categorypdca()
    {
        return $this->hasMany('App\categorypdca','Indicator_id','id');
    }
    public function category()
    {
        return $this->belongsTo('App\category','id');
    }
    public $timestamps = false;
    
}
