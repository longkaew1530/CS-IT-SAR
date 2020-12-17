<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docindicator4_3 extends Model
{
    protected $table = 'doc_indicator4_3';
    protected $primaryKey = 'doc_id';
    protected $fillable=[
        'doc_name','doc_file'
    ];
    public function indicator4_3()
    {
        return $this->hasMany('App\indicator4_3','doc_id');
    }
}
