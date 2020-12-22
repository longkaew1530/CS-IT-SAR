<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doc_performance3_3 extends Model
{
    protected $table = 'doc_indicator3_3';
    protected $primaryKey = 'doc_id';
    protected $fillable=[
        'doc_name','doc_file'
    ];
    public function performance3_3()
    {
        return $this->hasMany('App\performance3_3','doc_id');
    }
}
