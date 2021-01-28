<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doc_indicator5_4 extends Model
{
    protected $table = 'doc_indicator5_4';
    protected $primaryKey = 'doc_id';
    protected $fillable=[
        'doc_name','doc_file'
    ];
    public function indicator5_4()
    {
        return $this->hasMany('App\indicator5_4','doc_id');
    }
    public $timestamps = false;
}
