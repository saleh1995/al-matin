<?php

namespace App\Http\Controllers;

use App\FollowUp;
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
        $followup = FollowUp::all()->where('job_id', '=', $user_id)->first();
        $evaluation = Evaluation::all()->where('job_id', '=', $user_id)->first();
        return view('evaluation', ['followup' => $followup, 'evaluation' => $evaluation]);
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

        Excel::import(new FollowUpImport, $request->file);
        // return $this->sendResponse('', 'Excel was successfully uploaded');
    }
}
