<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicator4_3 extends Model
{
    protected $table = 'indicator4_3';
    protected $primaryKey = 'id';
    protected $fillable=[
        'retention_rate','category_retention_rate','target','performance_1','performance_2','performance_result','branch_id'
    ];
    public function docindicator4_3()
    {
        return $this->hasMany('App\docindicator4_3','doc_id','id');
    }
    public $timestamps = false;
}
