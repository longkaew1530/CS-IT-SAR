<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PDCA extends Model
{
    protected $table = 'pdca';
    protected $primaryKey = 'pdca_id';
    protected $fillable=[
        'Indicator_id','course_id','year_id','category_pdca','p','d','c','a','target','performance','score','m_id'
    ];
    public function docpdca()
    {
        return $this->hasMany('App\docpdca','pdca_id','pdca_id');
    }
    public function categorypdca()
    {
        return $this->hasMany('App\categorypdca','category_pdca');
    }
    public $timestamps = false;
}
