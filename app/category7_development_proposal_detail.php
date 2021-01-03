<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category7_development_proposal_detail extends Model
{
    protected $table = 'category7-development_proposal_detail';
    protected $primaryKey = 'id';
    protected $fillable=[
        'detail'
    ];
    public function development_proposal()
    {
        return $this->belongsTo('App\development_proposal','proposal_id','id');
    }
}
