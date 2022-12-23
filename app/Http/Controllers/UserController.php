<?php

namespace App\Http\Controllers;

use App\FollowUp;
use App\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\BaseController as BaseController;
use App\Role;

class UserController extends BaseController
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

        $file = $request->file('file')->store('Employee');

        Excel::import(new UsersImport, $file);
        return $this->sendResponse('', 'Excel was successfully uploaded');
    }

    public function show(Request $request)
    {
        // return response()->json(['user' => $request->user()]);
        // dd($request->all());

        $user = Auth::user();
        $user['manager_name'] = collect(DB::select('select name from users where job_id = ?', [$user->manager_id]))->first()->name;
        return $this->sendResponse($user, 'User Data');
    }


    public function departmentEmployees()
    {
        $employees = User::all()->where('manager_id', '=', Auth::user()->job_id);
        return view('employees', compact('employees'));
    }

    public function showEmployee(Request $request)
    {
        $data = $request->validate([
            'job_id' => 'required|numeric'
        ]);

        $employee = User::all()->where('job_id', '=', $data['job_id'])->first();

        return view('management', ['employee' => $employee]);
    }


    public function edit($id)
    {
        $employeeEdit = User::all()->where('job_id', '=', $id)->first();
        $employee = $employeeEdit;
        $roles = Role::all();
        $followUp = FollowUp::all()->where('job_id', '=', $id)->first();
        return view('management', compact(['employeeEdit', 'employee', 'roles', 'followUp']));
    }
}
