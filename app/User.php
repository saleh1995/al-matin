<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'job_id', 'password', 'address', 'place_of_job', 'phone', 'manager_id', 'internal_phone', 'vacation_status', 'role', 'change_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at', 'created_at', 'id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function manager()
    {
        return $this->hasMany('App\User', 'job_id', 'manager_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\User', 'manager_id', 'job_id');
    }

    public function salary()
    {
        return $this->hasOne('App\Salary', 'job_id', 'job_id');
    }

    public function role()
    {
        return $this->hasOne('App\Role', 'role', 'role');
    }
}
