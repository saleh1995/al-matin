<?php

namespace App\Imports;

use App\Insurance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Throwable;

class InsuranceImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row['date_registration']);
        return Insurance::updateOrCreate([
            'job_id' => $row['job_id'],
            'social_insurance' => $row['social_insurance'] == 'تامينات اجتماعية' ? 1 : 0,
            'insurance_salary' => $row['insurance_salary'] != NUll ? $row['insurance_salary'] : 0,
            'date_registration' => $row['date_registration'] != NULL ? Date::excelToDateTimeObject($row['date_registration']) : null,
            'social_insurance_number' => $row['social_insurance_number'] != NUll ? $row['social_insurance_number'] : 0,
            // 'remaining_advance' => $row['remaining_advance'],
        ]);
    }
}
