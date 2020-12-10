<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docpdca extends Model
{
    protected $table = 'doc_pdca';
    protected $primaryKey = 'pdca_id';
    protected $fillable=[
        'doc_name','doc_file'
    ];
    public function pdca()
    {
        return $this->hasMany('App\PDCA','pdca_id');
    }
}
