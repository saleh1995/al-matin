<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\Exports\VacationsExport;
use App\Role;
use App\User;
use App\FollowUp;
use App\Vacation;
use Carbon\Carbon;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\api\BaseController as BaseController;
use App\Insurance;
use App\Penalty;

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

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file')->store('Salary');
        // User::truncate();
        Excel::import(new UsersImport, $file);
        return redirect()->route('upload')->with('success', trans('translate.upload_success'))->with('subpage', 'employee');
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

    public function departmentEmployeesApi()
    {
        $employees = User::where('manager_id', '=', Auth::user()->job_id)->get();
        return $this->sendResponse($employees, 'Employees Data');
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
        //     return back()->withErrors(['job_id' => '???? ???????? ???????? ???? ?????? ?????????? ??????????????!']);
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

    public function update??Api(Request $request)
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

    public function deleteRelatedData($job_id)
    {
        $vacationsDelete    = Vacation::where('job_id', $job_id)->get();
        $evaluationsDelete  = Evaluation::where('job_id', $job_id)->get();
        $followupsDelete    = FollowUp::where('job_id', $job_id)->get();
        $insurancesDelete   = Insurance::where('job_id', $job_id)->get();
        $penaltiesDelete    = Penalty::where('job_id', $job_id)->get();
        if ($vacationsDelete) {
            foreach ($vacationsDelete as $key => $vacationDelete) {
                $vacationDelete->delete();
            }
        }
        if ($evaluationsDelete) {
            foreach ($evaluationsDelete as $key => $evaluationDelete) {
                $evaluationDelete->delete();
            }
        }
        if ($followupsDelete) {
            foreach ($followupsDelete as $key => $followupDelete) {
                $followupDelete->delete();
            }
        }
        if ($insurancesDelete) {
            foreach ($insurancesDelete as $key => $insuranceDelete) {
                $insuranceDelete->delete();
            }
        }
        if ($penaltiesDelete) {
            foreach ($penaltiesDelete as $key => $penalty) {
                $penalty->delete();
            }
        }
    }

    public function delete(Request $request)
    {
        $employeeDelete = User::where('job_id', $request->id)->first();
        $this->deleteRelatedData($employeeDelete->job_id);
        $employeeDelete->delete();
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
        $this->deleteRelatedData($request->job_id);
        return $this->sendResponse($employeeDelete, 'Employee was deleted successfully!');
    }

    public function statisticsData()
    {
        $employeeCount = User::all()->count();
        $headCount = User::all()->where('role', '>', 0)->where('role', '!=', 99)->count();
        $vacationCount = Vacation::all()->where('request_status', '=', 3)->where('end_date', '>=', Carbon::today()->toDateString())->where('start_date', '<=', Carbon::today()->toDateString())->count();
        $waitingVacations = Vacation::whereIn('request_status', [1, 2])->where('end_date', '>=', Carbon::today()->toDateString())->with('user')->get();

        $data = [
            'employeeCount' => $employeeCount,
            'headCount' => $headCount,
            'vacationCount' => $vacationCount,
            'waitingVacations' => $waitingVacations,
        ];
        return $data;
    }


    public function statistics()
    {
        $data = $this->statisticsData();
        $vacations = Vacation::where('request_status', 3)->where(function ($query) {
            $query->where('start_date', '>=', Carbon::today()->toDateString())
                ->orWhere('end_date', '>=', Carbon::today()->toDateString());
        })->where('start_date', '<=', Carbon::today()->toDateString())->get();
        // dd($vacations);
        $data['vacations'] = $vacations;
        return view('statistics', $data);
    }

    public function statisticsApi()
    {
        $data = $this->statisticsData();
        $vacations = Vacation::where('request_status', 3)->where(function ($query) {
            $query->where('start_date', '>=', Carbon::today()->toDateString())
                ->orWhere('end_date', '>=', Carbon::today()->toDateString());
        })->where('start_date', '<=', Carbon::today()->toDateString())->with('user')->get();
        // dd($vacations);
        $data['todayAcceptedVacations'] = $vacations;
        return $this->sendResponse($data, 'Statistics Count');
    }

    public function statisticsVacation(Request $request)
    {
        $data = $this->statisticsData();
        // $vacations = Vacation::all()->where('request_status', '=', 3)->where('end_date', '<=', $request->end_date)->where('start_date', '>=', $request->start_date);
        $vacations = Vacation::where('request_status', 3)->where(function ($query) use ($request) {
            $query->where('start_date', '>=', $request->start_date)
                ->orWhere('end_date', '>=', $request->start_date);
        })->where('start_date', '<=', $request->end_date)->get();
        // dd($vacations);
        $data['vacations'] = $vacations;
        $data['request'] = $request;
        // dd($request->all());
        if ($request->btndate == 2) {
            return Excel::download(new VacationsExport($request), 'vacations.xls');
        }
        return view('statistics', $data);
    }

    public function statisticsVacationApi(Request $request)
    {
        $data = Validator::make(
            $request->all(),
            [
                'start_date' => 'required|date_format:m-d-Y',
                'end_date' => 'required|date_format:m-d-Y',
            ]
        );

        if ($data->fails()) {
            return $this->sendError('Validation Error.', $data->errors());
        }

        $vacations = Vacation::where('request_status', 3)->where(function ($query) use ($request) {
            $query->where('start_date', '>=', Carbon::createFromFormat('m-d-Y', $request->start_date))
                ->orWhere('end_date', '>=', Carbon::createFromFormat('m-d-Y', $request->start_date));
        })->where('start_date', '<=', Carbon::createFromFormat('m-d-Y', $request->end_date))->with('user')->get();

        if (isset($request->btndate) && $request->btndate == 2) {
            return Excel::download(new VacationsExport($request), 'vacations.xls');
        }
        return $this->sendResponse($vacations, "all accepted vacations between $request->start_date and $request->end_date");
    }

    // public function statisticsVacationExcelExport()
    // {
    //     return Excel::download(new VacationsExport, 'vacations.xls');
    //     return redirect()->back();
    // }
}
