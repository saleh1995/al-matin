<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\BaseController;
use App\Salary;
use Illuminate\Http\Request;
use App\Imports\SalariesImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class SalaryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $file = $request->file('file')->store('Salary');
        Salary::truncate();
        Excel::import(new SalariesImport, $file);
        return $this->sendResponse('', 'Excel was successfully uploaded');
    }


    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file')->store('Salary');
        Salary::truncate();
        Excel::import(new SalariesImport, $file);
        return redirect()->route('upload')->with('success', trans('translate.upload_success'))->with('subpage', 'salary');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        $user_id = Auth::user()->job_id;
        $salary = Salary::all()->where('job_id', '=', $user_id)->first();

        // if ($salary == null) {
        //     $zero = Salary::all()->where('job_id', '=', $user_id)->first();
        //     if ($zero == null) {
        //         $salary = new Salary();
        //         $salary->job_id = $user_id;
        //         $salary->save();
        //     }
        // }
        return view('salary', ['salary' => $salary]);
    }


    public function showApi(Salary $salary)
    {
        $user_id = Auth::user()->job_id;
        $salary = Salary::all()->where('job_id', '=', $user_id)->first();
        return $this->sendResponse($salary, 'Salary Data');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        //
    }
}
