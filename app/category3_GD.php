<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category3_GD extends Model
{
    protected $table = 'category3';
    protected $primaryKey = 'id';
    protected $fillable=[
        'stu_year_of_admission','stu_year','stu_qty','gd_year_of_admission'
        ,'gd_of_ad_qty','gd_year','gd_qty','gd_persen','factor','category_factor','branch_id'
    ];
    public $timestamps = false;
}
