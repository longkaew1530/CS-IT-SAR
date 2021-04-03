<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicator5_4 extends Model
{
    protected $table = 'indicator5_4';
    protected $primaryKey = 'id';
    protected $fillable=[
        'performance','status','in_index_id'
    ];
    public function doc_indicator5_4()
    {
        return $this->hasMany('App\doc_indicator5_4','doc_id','id');
    }
    public function in_index()
    {
        return $this->belongsTo('App\in_index','in_index_id');
    }
    public $timestamps = false;
}
