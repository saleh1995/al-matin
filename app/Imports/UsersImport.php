<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class UsersImport implements ToModel, WithHeadingRow, SkipsOnError
// , WithBatchInserts, WithChunkReading
{

    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'job_id' => $row['job_id'],
            'name' => $row['name'],
            'password' => Hash::make($row['password']),
            'address' => $row['address'],
            'place_of_job' => $row['place_of_job'],
            'phone' => $row['phone'],
            'manager_id' => $row['manager_id']
        ]);
    }

    public function onError(Throwable $e)
    {
    }

    // public function batchSize(): int
    // {
    //     return 100;
    // }

    // public function chunkSize(): int
    // {
    //     return 100;
    // }
}
