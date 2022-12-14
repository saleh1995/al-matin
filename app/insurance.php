<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'job_id', 'social_insurance', 'insurance_salary', 'date_registration', 'remaining_advance', 'social_insurance_number',
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'job_id', 'job_id');
    }
}
