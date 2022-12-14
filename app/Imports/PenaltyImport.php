<?php

namespace App\Imports;

use App\Penalty;
use Maatwebsite\Excel\Concerns\ToModel;

class PenaltyImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Penalty([
            'job_id' => $row['job_id'],
            'penalties' => $row['penalties'],
            'final_ammount' => $row['final_ammount'],
            'penalties_date' => $row['penalties_date'],
        ]);
    }
}
