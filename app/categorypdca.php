<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categorypdca extends Model
{
    protected $table = 'categorypdca';
    protected $primaryKey = 'Indicator_id';
    protected $fillable=[
        'category_name'
    ];
    public function Indicator()
    {
        return $this->hasMany('App\indicator','indicator');
    }
    public function pdca()
    {
        return $this->hasMany('App\PDCA','category_pdca','id');
    }
}
