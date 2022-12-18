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

class FollowUpController extends Controller
{
    public function show()
    {
        $user_id = Auth::user()->job_id;
        $evaluation = Evaluation::all()->where('job_id', '=', $user_id)->first();
        $followUp = FollowUp::all()->where('job_id', '=', $user_id)->first();
        $insurance = Insurance::all()->where('job_id', '=', $user_id)->first();
        $penalty = Penalty::all()->where('job_id', '=', $user_id)->first();
        return view('evaluation', ['evaluation' => $evaluation, 'followUp' => $followUp, 'insurance' => $insurance, 'penalty' => $penalty]);
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

        Excel::import(new FollowUpImport, $file);
        // return $this->sendResponse('', 'Excel was successfully uploaded');
    }
}
