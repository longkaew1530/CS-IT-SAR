<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $fillable=[
        'category_name','category_year_id'
    ];
    public function indicator()
    {
        return $this->hasMany('App\indicator','category_id','category_id')
        ->select('indicator.id','indicator.Indicator_id','indicator.url','indicator.Indicator_name','indicator.year_id','user_permission.user_id','user_permission.year_id')
        ->leftjoin('user_permission','indicator.id','=','user_permission.indicator_id')
        ->where('user_permission.user_id',$user=auth()->user()->id)
        ->where('indicator.year_id',session()->get('year_id'))
        ->where('indicator.course_id',session()->get('usercourse'))
        ->where('user_permission.year_id',session()->get('year_id'));
    }
    public function indicator2()
    {
        return $this->hasMany('App\indicator','category_id','category_id')
        ->where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('usercourse'))
        ->where('active',1);
    }
    public $timestamps = false;
}
