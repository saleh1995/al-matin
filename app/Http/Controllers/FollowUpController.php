<?php

namespace App\Http\Controllers;

use App\Penalty;
use App\FollowUp;
use App\Insurance;
use App\Evaluation;
use Illuminate\Http\Request;
use App\Imports\FollowUpImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class FollowUpController extends EvaluationController
{
    public function showApi()
    {
        $user_id = Auth::user()->job_id;
        // $evaluation = Evaluation::all()->where('job_id', '=', $user_id)->first();
        $followUp = FollowUp::all()->where('job_id', '=', $user_id)->first();
        // $insurance = Insurance::all()->where('job_id', '=', $user_id)->first();
        // $penalty = Penalty::all()->where('job_id', '=', $user_id)->first();
        // $collection = collect(['evaluation' => $evaluation, 'followup' => $followUp, 'insuranc' => $insurance, 'penalty' => $penalty]);

        return $this->sendResponse($followUp, 'all data');
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

        $file = $request->file('file')->store('FollowUp');
        // FollowUp::truncate();

        Excel::import(new FollowUpImport, $file);
        return $this->sendResponse('', 'Excel was successfully uploaded');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file')->store('Salary');
        // FollowUp::truncate();
        Excel::import(new FollowUpImport, $file);
        return redirect()->route('upload')->with('success', trans('translate.upload_success'))->with('subpage', 'followUp');
    }

    public function editApi(Request $request)
    {
        $data = Validator::make(
            [
                'job_id'      => $request->job_id,
            ],
            [
                'job_id' => 'required|numeric'
            ]
        );

        if ($data->fails()) {
            return $this->sendError('Validation Error.', $data->errors());
        }

        $followUp = FollowUp::all()->where('job_id', '=', $request->job_id)->first();

        return $this->sendResponse($followUp, 'FollowUp Data');
    }

    public function update(Request $request)
    {
        FollowUp::updateOrCreate(['job_id' => $request->job_id], $request->all());

        session()->flash('success', trans('translate.update_success'));
        return redirect()->back();
    }

    public function updateApi(Request $request)
    {
        $data = Validator::make(
            [
                'job_id'      => $request->job_id,
            ],
            [
                'job_id' => 'required|numeric'
            ]
        );

        if ($data->fails()) {
            return $this->sendError('Validation Error.', $data->errors());
        }

        $followUp = FollowUp::updateOrCreate(['job_id' => $request->job_id], $request->all());

        return $this->sendResponse($followUp, 'FollowUp Data');
    }
}
