<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculty';
    protected $primaryKey = 'faculty_id';
    protected $fillable=[
        'faculty_name'
    ];
    public function course()
    {
        return $this->hasMany('App\Course','faculty_id','faculty_id');
    }
    public $timestamps = false;
}
