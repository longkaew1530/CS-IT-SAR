<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class in_index extends Model
{
    protected $table = 'indicator_index';
    protected $primaryKey = 'id';
    protected $fillable=[
        'name'
    ];
    public function indicator5_4()
    {
        return $this->hasMany('App\indicator5_4','in_index_id','id')
        ->where('year_id',session()->get('year_id'))
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'));
    }
}
