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
            'pros' => $row['pros'],
            'cons' => $row['cons'],
            'manager_recommendations' => $row['manager_recommendations'],
            'hr_recommendations' => $row['hr_recommendations'],

        ]);
    }

    public function onError(Throwable $e)
    {
    }
}
