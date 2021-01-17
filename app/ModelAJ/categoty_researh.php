<?php

namespace App\ModelAJ;

use Illuminate\Database\Eloquent\Model;

class categoty_researh extends Model
{
    protected $table = 'category_research_results';
    protected $primaryKey = 'id';
    protected $fillable=[
        'name','score'
    ];
    public function research_results()
    {
        return $this->hasMany('App\ModelAJ\Research_results','research_results_category','id');
    }
}
