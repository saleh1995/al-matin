<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id', 'base_salary', 'motivations', 'living_compensation', 'additional', 'food_allowance', 'productivity_motivations', 'nature_work', 'variable_compensation', 'fixed_compensation', 'total_benefit', 'absence', 'absence_cut', 'without_salary', 'without_salary_cut', 'late_cut', 'mobile_bill', 'punishments', 'ordinary_advance', 'jop', 'social_insurance', 'income_tax', 'cooperat_box', 'net_salary', 'severance_pay'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'job_id', 'job_id');
    }
}
