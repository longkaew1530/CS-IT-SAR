<?php

namespace App;

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
        return $this->hasMany('App\ModelAJ\Research_results','research_results_category','id')
        ->rightjoin('course_responsible_teacher','research_results.owner','=','course_responsible_teacher.user_id')
        ->where('course_responsible_teacher.year_id',session()->get('year_id'))
        ->where('course_responsible_teacher.course_id',session()->get('usercourse'));
    }
}
