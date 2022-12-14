<?php

namespace App\Imports;

use App\Insurance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Throwable;

class InsuranceImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        dd(strtotime($row['date_registration']));
        return new Insurance([
            'job_id' => $row['job_id'],
            'social_security' => $row['social_security'],
            'insurance_salary' => $row['insurance_salary'],
            'date_registration' => ((strtotime($row['date_registration']) != NULL) ? NULL : Date::excelToDateTimeObject($row['date_registration'])),
            'social_insurance_number' => $row['social_insurance_number'],
            // 'remaining_advance' => $row['remaining_advance'],
        ]);
    }

    public function onError(Throwable $e)
    {
    }
}
