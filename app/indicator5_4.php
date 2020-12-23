<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicator5_4 extends Model
{
    protected $table = 'indicator5_4';
    protected $primaryKey = 'id';
    protected $fillable=[
        'performance','status','category'
    ];
    public function doc_indicator5_4()
    {
        return $this->hasMany('App\doc_indicator5_4','doc_id','id');
    }
}
