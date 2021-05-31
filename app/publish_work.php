<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class publish_work extends Model
{
    protected $table = 'publish_work';
    protected $primaryKey = 'publish_id';
    protected $fillable=[
        'owner','teacher_name','category_publish_work','publish_work_year','publish_work_yearshow','publish_work_name','publish_work_issue','publish_work_page'
        ,'publish_work_date','publish_work_place','province','country','journal_name','category','publish_work_yearanddate','publish_work_yearanddate2'
    ];
    public function category_research_results()
    {
        return $this->belongsTo('App\ModelAJ\categoty_researh');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public $timestamps = false;
}
