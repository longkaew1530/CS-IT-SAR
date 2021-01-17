<?php

namespace App\ModelAJ;

use Illuminate\Database\Eloquent\Model;

class Research_results_user extends Model
{
    protected $table = 'research_results_user';
    protected $primaryKey = 'research_results_research_results_id';
    protected $fillable=[
        'research_results_research_results_id','user_id '
    ];
    public $timestamps = false;
}
