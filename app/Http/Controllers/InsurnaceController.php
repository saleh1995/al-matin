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

class InsurnaceController extends EvaluationController
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

        $file = $request->file('file')->store('Insurance');
        Insurance::truncate();

        Excel::import(new InsuranceImport, $file);
        // return $this->sendResponse('', 'Excel was successfully uploaded');
    }
}
