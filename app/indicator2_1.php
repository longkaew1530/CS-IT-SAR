<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicator2_1 extends Model
{
    protected $table = 'indicator2_1';
    protected $primaryKey = 'id';
    protected $fillable=[
        'qtyall','qtyrate','persen','sumscore','resultscore'
    ];
}
