<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','user_fullname', 'username', 'password','email','user_faculty','user_ course','user_group_id','academic_position','image','user_branch'
    ];
    public function educational_background()
    {
        return $this->hasMany('App\Educational_background','user_id','id');
    }
    public function research_results()
    {
        return $this->belongsToMany('App\ModelAJ\Research_results');
    }
    public function user_permission()
    {
        return $this->hasMany('App\user_permission','user_id','id')
        ->leftjoin('indicator','user_permission.Indicator_id','=','indicator.id');
    }
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
