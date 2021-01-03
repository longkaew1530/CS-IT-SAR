<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category7_development_proposal extends Model
{
    protected $table = 'category7-development_proposal';
    protected $primaryKey = 'id';
    protected $fillable=[
        'topic'
    ];
    public function development_proposal_detail()
    {
        return $this->hasMany('App\category7_development_proposal_detail','proposal_id');
    }
}
