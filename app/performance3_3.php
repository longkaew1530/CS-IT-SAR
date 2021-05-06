<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class performance3_3 extends Model
{
    protected $table = 'indicator3_3';
    protected $primaryKey = 'id';
    protected $fillable=[
        'retention_rate','category_retention_rate','branch_id'
    ];
    public function doc_performance3_3()
    {
        return $this->hasMany('App\doc_performance3_3','doc_id','id');
    }
    public $timestamps = false;
}
