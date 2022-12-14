<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'latest_evaluation', 'manager_evaluation', 'hr_evaluation', 'pros', 'cons', 'manager_recommendations', 'hr_recommendations'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'job_id', 'job_id');
    }
}
