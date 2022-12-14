<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\FollowUp;
use App\Imports\EvaluationImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller
{
    public function show()
    {
        $user_id = Auth::user()->job_id;
        $evaluation = Evaluation::all()->where('job_id', '=', $user_id)->first();
        $followUp = FollowUp::all()->where('job_id', '=', $user_id)->first();
        return view('evaluation', ['evaluation' => $evaluation, 'followUp' => $followUp]);
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

        Excel::import(new EvaluationImport, $request->file);
        // return $this->sendResponse('', 'Excel was successfully uploaded');
    }
}