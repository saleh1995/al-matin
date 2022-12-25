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



    public function management()
    {
        return view('management');
    }

    public function showEmployee(Request $request)
    {
        $data = $request->validate([
            'job_id' => 'required|numeric'
        ]);

        $employee = User::all()->where('job_id', '=', $data['job_id'])->first();

        // if (!$employee) {
        //     return back()->withErrors(['job_id' => 'لا يوجد موظف مع هذا الرقم الوظيفي!']);
        // }

        return view('management', ['employee' => $employee]);
    }

    public function showEmployeeApi(Request $request)
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

        $employee = User::all()->where('job_id', '=', $request->job_id)->first();

        return $this->sendResponse($employee, 'Employee Data');
    }


    public function edit($id)
    {
        $employeeEdit = User::all()->where('job_id', '=', $id)->first();
        $employee = $employeeEdit;
        $roles = Role::all();
        $followUp = FollowUp::all()->where('job_id', '=', $id)->first();
        return view('management', compact(['employeeEdit', 'employee', 'roles', 'followUp']));
    }


    public function update(Request $request)
    {
        $id = $request->job_id;
        $employeeEdit = User::all()->where('job_id', '=', $id)->first()->update($request->all());

        session()->flash('success', trans('translate.update_success'));

        return redirect()->back();
    }

    public function updateِApi(Request $request)
    {
        $data = Validator::make(
            $request->all(),
            [
                'job_id' => 'required|numeric',
                'name' => 'required',
            ]
        );

        if ($data->fails()) {
            return $this->sendError('Validation Error.', $data->errors());
        }

        $id = $request->job_id;
        $employeeEdit = User::all()->where('job_id', '=', $id)->first()->update($request->all());

        return $this->sendResponse($employeeEdit, 'Employee Data was updated successfully!');
    }


    public function changePassword(Request $request)
    {
        $id = $request->job_id;
        $request->validate([
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password'
        ]);
        $employeeEdit = User::all()->where('job_id', '=', $id)->first()->update(['password' => bcrypt($request->password)]);

        session()->flash('success', trans('translate.update_success'));
        return redirect()->back();
    }

    public function changePasswordApi(Request $request)
    {
        $data = Validator::make(
            $request->all(),
            [
                'job_id' => 'required|numeric',
                'password' => 'required|min:5',
                'password_confirmation' => 'required|same:password'
            ]
        );

        if ($data->fails()) {
            return $this->sendError('Validation Error.', $data->errors());
        }
        $id = $request->job_id;

        $employeeEdit = User::all()->where('job_id', '=', $id)->first()->update(['password' => bcrypt($request->password)]);

        return $this->sendResponse($employeeEdit, 'Employee password was updated successfully!');
    }

    public function delete(Request $request)
    {
        User::where('job_id', $request->id)->delete();
        session()->flash('success', trans('translate.update_success'));
        return redirect()->back();
    }

    public function deleteApi(Request $request)
    {
        $data = Validator::make(
            $request->all(),
            [
                'job_id' => 'required|numeric',
            ]
        );

        if ($data->fails()) {
            return $this->sendError('Validation Error.', $data->errors());
        }
        $employeeDelete = User::where('job_id', $request->job_id)->delete();
        return $this->sendResponse($employeeDelete, 'Employee was deleted successfully!');
    }
}
