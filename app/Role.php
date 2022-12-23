<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'name'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'role', 'role');
    }
}
