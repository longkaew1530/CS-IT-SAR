<?php

namespace App\ModelAJ;

use Illuminate\Database\Eloquent\Model;

class Research_results extends Model
{
    protected $table = 'research_results';
    protected $primaryKey = 'research_results_id';
    protected $fillable=[
        'owner','research_results_category','research_results_year','research_results_name',
        'research_results_source_salary','research_results_salary','source_salary','research_results_date'
    ];
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function category_research_results()
    {
        return $this->belongsTo('App\ModelAJ\categoty_researh');
    }
    public $timestamps = false;
}
