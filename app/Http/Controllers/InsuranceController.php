<?php

namespace App\Http\Controllers;

use App\FollowUp;
use App\Evaluation;
use App\Imports\InsuranceImport;
use App\Insurance;
use App\Penalty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class InsuranceController extends EvaluationController
{
    public function showApi()
    {
        $user_id = Auth::user()->job_id;
        // $evaluation = Evaluation::all()->where('job_id', '=', $user_id)->first();
        // $followUp = FollowUp::all()->where('job_id', '=', $user_id)->first();
        $insurance = Insurance::all()->where('job_id', '=', $user_id)->first();
        // $penalty = Penalty::all()->where('job_id', '=', $user_id)->first();
        // $collection = collect(['evaluation' => $evaluation, 'followup' => $followUp, 'insuranc' => $insurance, 'penalty' => $penalty]);

        return $this->sendResponse($insurance, 'all data');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'file'      => $request->file,
                'extension' => strtolower($request->file->getClientOriginalExtension()),
            ],
            [
                'file'          => 'required',
                'extension'      => 'required|in:xlsx,xls',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $file = $request->file('file')->store('Insurance');
        Insurance::truncate();

        // Insurance::truncate();
        Excel::import(new InsuranceImport, $file);
        return $this->sendResponse('', 'Excel was successfully uploaded');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file')->store('Salary');
        // Insurance::truncate();
        Excel::import(new InsuranceImport, $file);
        return redirect()->route('upload')->with('success', trans('translate.upload_success'))->with('subpage', 'insurance');
    }
}
