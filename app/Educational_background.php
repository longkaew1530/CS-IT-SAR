<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educational_background extends Model
{
    protected $table = 'educational_background';
    protected $primaryKey = 'id';
    protected $fillable=[
        'eb_yearsuccess','eb_name','eb_fieldofstudy','abbreviations','education'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
