<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'head_id', 'start_date', 'end_date', 'reasons', 'request_status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'job_id', 'job_id');
    }
}
