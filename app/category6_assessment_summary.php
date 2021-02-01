<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category6_assessment_summary extends Model
{
    protected $table = 'category6-assessment_summary';
    protected $primaryKey = 'id';
    protected $fillable=[
        'category_assessor','evaluation_results','comment_faculty','change_proposal'
    ];
    public $timestamps = false;
}
