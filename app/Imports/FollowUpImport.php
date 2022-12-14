<?php

namespace App\Imports;

use App\FollowUp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class FollowUpImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return FollowUp::updateOrCreate(
            [
                'job_id' => $row['job_id']
            ],
            [
                'job_id' => $row['job_id'],
                'id_photo' => $row['id_photo'] ?? 0,
                'residence_document' => $row['residence_document'] ?? 0,
                'no_conviction' => $row['no_conviction'] ?? 0,
                'individual_civil_record' => $row['individual_civil_record'] ?? 0,
                'personal_photos' => $row['personal_photos'] ?? 0,
                'certificate_copy' => $row['certificate_copy'] ?? 0,
                'medical_report' => $row['medical_report'] ?? 0,
                'military_notebook' => $row['military_notebook'] ?? 0,
            ]
        );
    }

    public function onError(Throwable $e)
    {
    }
}
