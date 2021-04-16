<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicator extends Model
{
    protected $table = 'indicator';
    protected $primaryKey = 'id';
    protected $fillable=[
        'Indicator_id','Indicator_name','year_id','category_id','composition_id','url','active'
    ];
    public function Categorypdca()
    {
        return $this->hasMany('App\categorypdca','Indicator_id','Indicator_id');
    }
    public function category()
    {
        return $this->belongsTo('App\category','id');
    }
    public $timestamps = false;
    
}
