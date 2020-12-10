<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PDCA extends Model
{
    protected $table = 'pdca';
    protected $primaryKey = 'pdca_id';
    protected $fillable=[
        'Indicator_id','course_id','year_id','category_pdca','p','d','c','a','target','performance','score'
    ];
    public function docpdca()
    {
        return $this->hasMany('App\docpdca','pdca_id','pdca_id');
    }
}
