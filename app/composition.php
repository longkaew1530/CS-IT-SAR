<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class composition extends Model
{
    protected $table = 'composition';
    protected $primaryKey = 'id';
    protected $fillable=[
        'name',
    ];
    public function category7_strengths_summary()
    {
        return $this->hasMany('App\category7_strengths_summary','composition_id','id')
        ->where('course_id',session()->get('usercourse'))
        ->where('branch_id',session()->get('branch_id'))
        ->where('year_id',session()->get('year_id'));
    }
}
