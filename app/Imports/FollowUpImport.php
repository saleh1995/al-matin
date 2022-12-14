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
        return new FollowUp([
            'job_id' => $row['job_id'],
            'id_photo' => $row['id_photo'],
            'residence_document' => $row['residence_document'],
            'no_conviction' => $row['no_conviction'],
            'individual_civil_record' => $row['individual_civil_record'],
            'personal_photos' => $row['personal_photos'],
            'certificate_copy' => $row['certificate_copy'],
            'medical_report' => $row['medical_report'],
            'military_notebook' => $row['military_notebook'],
        ]);
    }

    public function onError(Throwable $e)
    {
    }
}
