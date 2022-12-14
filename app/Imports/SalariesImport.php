<?php

namespace App\Imports;

use App\Salary;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class SalariesImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Salary([
            'job_id' => $row['job_id'],
            'base_salary' => $row['base_salary'],
            'motivations' => $row['motivations'],
            'living_compensation' => $row['living_compensation'],
            'additional' => $row['additional'],
            'food_allowance' => $row['food_allowance'],
            'productivity_motivations' => $row['productivity_motivations'],
            'nature_work' => $row['nature_work'],
            'variable_compensation' => $row['variable_compensation'],
            'fixed_compensation' => $row['fixed_compensation'],
            'total_benefit' => $row['total_benefit'],
            'absence' => $row['absence'],
            'absence_cut' => $row['absence_cut'],
            'without_salary' => $row['without_salary'],
            'without_salary_cut' => $row['without_salary_cut'],
            'late_cut' => $row['late_cut'],
            'mobile_bill' => $row['mobile_bill'],
            'punishments' => $row['punishments'],
            'ordinary_advance' => $row['ordinary_advance'],
            'jop' => $row['jop'],
            'social_insurance' => $row['social_insurance'],
            'income_tax' => $row['income_tax'],
            'cooperat_box' => $row['cooperat_box'],
            'net_salary' => $row['net_salary'],
            'severance_pay' => $row['severance_pay'],
        ]);
    }

    public function onError(Throwable $e)
    {
    }
}
