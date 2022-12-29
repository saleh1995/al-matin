<?php

namespace App\Exports;

use App\Vacation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VacationsExport implements FromCollection, WithMapping, WithHeadings
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $request = $this->request;
        return Vacation::with('user')->where('request_status', 3)->where(function ($query) use ($request) {
            $query->where('start_date', '>=', $request->start_date)
                ->orWhere('end_date', '>=', $request->start_date);
        })->where('start_date', '<=', $request->end_date)->get();
    }

    public function map($vacation): array
    {
        return [
            $vacation->job_id,
            $vacation->user->name,
            $vacation->user->place_of_job,
            $vacation->start_date,
            $vacation->end_date,
            $vacation->reasons,
        ];
    }
    public function headings(): array
    {
        return [trans('translate.emp_id'), trans('translate.emp_name'), trans('translate.emp_place_of_job'), trans('translate.start_date'), trans('translate.end_date'), trans('translate.reasons')];
    }
}
