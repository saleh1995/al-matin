<?php

namespace App\Http\Controllers;

use App\Penalty;
use App\FollowUp;
use App\Insurance;
use App\Evaluation;
use App\Http\Controllers\api\BaseController;
use Illuminate\Http\Request;
use App\Imports\EvaluationImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends BaseController
{
    public function show()
    {
        $user_id = Auth::user()->job_id;
        $evaluation = Evaluation::all()->where('job_id', '=', $user_id)->first();
        $followUp = FollowUp::all()->where('job_id', '=', $user_id)->first();
        $insurance = Insurance::all()->where('job_id', '=', $user_id)->first();
        $penalty = Penalty::all()->where('job_id', '=', $user_id)->first();
        // if ($evaluation == null) {
        //     $zero = Evaluation::all()->where('job_id', '=', $user_id)->first();
        //     if ($zero == null) {
        //         $evaluation = new Evaluation();
        //         $evaluation->job_id = $user_id;
        //         $evaluation->save();
        //     }
        // }


        // if ($followUp == null) {
        //     $zero = FollowUp::all()->where('job_id', '=', $user_id)->first();
        //     if ($zero == null) {
        //         $followUp = new FollowUp();
        //         $followUp->job_id = $user_id;
        //         $followUp->save();
        //     }
        // }

        // if ($insurance == null) {
        //     $zero = Insurance::all()->where('job_id', '=', $user_id)->first();
        //     if ($zero == null) {
        //         $insurance = new Insurance();
        //         $insurance->job_id = $user_id;
        //         $insurance->save();
        //     }
        // }

        // if ($penalty == null) {
        //     $zero = Penalty::all()->where('job_id', '=', $user_id)->first();
        //     if ($zero == null) {
        //         $penalty = new Penalty();
        //         $penalty->job_id = $user_id;
        //         $penalty->save();
        //     }
        // }
        return view('evaluation', ['evaluation' => $evaluation, 'followUp' => $followUp, 'insurance' => $insurance, 'penalty' => $penalty]);
    }

    public function showApi()
    {
        $user_id = Auth::user()->job_id;
        $evaluation = Evaluation::all()->where('job_id', '=', $user_id)->first();
        // $followUp = FollowUp::all()->where('job_id', '=', $user_id)->first();
        // $insurance = Insurance::all()->where('job_id', '=', $user_id)->first();
        // $penalty = Penalty::all()->where('job_id', '=', $user_id)->first();
        // $collection = collect(['evaluation' => $evaluation, 'followup' => $followUp, 'insuranc' => $insurance, 'penalty' => $penalty]);

        return $this->sendResponse($evaluation, 'all data');
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

        $file = $request->file('file')->store('Evaluation');
        Evaluation::truncate();

        Excel::import(new EvaluationImport, $file);
        // return $this->sendResponse('', 'Excel was successfully uploaded');
    }
}
