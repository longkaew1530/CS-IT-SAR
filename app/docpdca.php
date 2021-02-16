<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docpdca extends Model
{
    protected $table = 'doc_pdca';
    protected $primaryKey = 'doc_id';
    protected $fillable=[
        'doc_name','doc_file','pdca_id'
    ];
    public function pdca()
    {
        return $this->hasMany('App\PDCA','pdca_id');
    }
}
