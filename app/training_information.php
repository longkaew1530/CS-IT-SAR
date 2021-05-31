<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class training_information extends Model
{
    protected $table = 'training_information';
    protected $primaryKey = 'id';
    protected $fillable=[
        'user_id','name_training','date_training','place_training','category_training','year_id','date_training2'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public $timestamps = false;
}
