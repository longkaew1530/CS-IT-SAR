<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class publish_work_user extends Model
{
    protected $table = 'publish_work_user';
    protected $primaryKey = 'publish_work_publish_id';
    protected $fillable=[
        'publish_work_publish_id','user_id'
    ];
    public $timestamps = false;
}
