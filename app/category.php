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
        ->select('indicator.id','indicator.Indicator_id','indicator.url','indicator.Indicator_name')
        ->leftjoin('user_permission','indicator.id','=','user_permission.indicator_id')
        ->where('user_permission.user_id',$user=auth()->user()->id)
        ->where('indicator.year_id',session()->get('year_id'));
    }
    public function indicator2()
    {
        return $this->hasMany('App\indicator','category_id','category_id')
        ->where('year_id',session()->get('year_id'));
    }
    public $timestamps = false;
}
