<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'id_photo', 'residence_document', 'no_conviction', 'individual_civil_record', 'personal_photos', 'certificate_copy', 'medical_report', 'military_notebook',
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'job_id', 'job_id');
    }
}
