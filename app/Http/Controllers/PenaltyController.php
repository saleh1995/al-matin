<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FollowUp;
use App\Evaluation;
use App\Imports\PenaltyImport;
use App\Insurance;
use App\Penalty;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class PenaltyController extends EvaluationController
{
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

        $file = $request->file('file')->store('Penalty');
        Penalty::truncate();


        Excel::import(new PenaltyImport, $file);
        // return $this->sendResponse('', 'Excel was successfully uploaded');
    }
}
