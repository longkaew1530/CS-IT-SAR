<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category6_comment_course extends Model
{
    protected $table = 'category6-comment-course';
    protected $primaryKey = 'id';
    protected $fillable=[
        'comment_assessor','comment_course_responsible_person','update_course','branch_id'
    ];
    public $timestamps = false;
}
