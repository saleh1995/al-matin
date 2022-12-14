<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $table = 'penalties';

    protected $fillable = [
        'job_id', 'penalties', 'final_ammount', 'penalties_date',
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'job_id', 'job_id');
    }
}
