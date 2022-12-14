<?php

namespace App\Imports;

use App\Evaluation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class EvaluationImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Evaluation([
            'job_id' => $row['job_id'],
            'latest_evaluation' => $row['latest_evaluation'],
            'manager_evaluation' => $row['manager_evaluation'],
            'hr_evaluation' => $row['hr_evaluation'],
            'social_security' => $row['social_security'],
            'insurance_salary' => $row['insurance_salary'],
            'date_registration' => $row['date_registration'],
            'remaining_advance' => $row['remaining_advance'],
        ]);
    }

    public function onError(Throwable $e)
    {
    }
}
