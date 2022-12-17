<?php

namespace App\Imports;

use App\Penalty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Throwable;

class PenaltyImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $x = date("Y-m-d", $row['penalties_date']);
        // dd($row['penalties_date']);
        return new Penalty([
            'job_id' => $row['job_id'],
            'penalties' => $row['penalties'] != NUll ? $row['penalties'] : 0,
            'final_ammount' => $row['final_ammount'] != NUll ? $row['final_ammount'] : 0,
            'penalties_date' => (isset($row['penalties_date'])) ? Date::excelToDateTimeObject($row['penalties_date']) : NULL,
        ]);
    }

    public function onError(Throwable $e)
    {
    }
}
