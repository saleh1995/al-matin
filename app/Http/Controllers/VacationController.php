<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\BaseController;
use App\User;
use App\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacationController extends BaseController
{
    public function show()
    {
        $employee = Auth::user();
        $vacation = Vacation::all()->where('job_id', '=', $employee->job_id)->where('request_status', '<>', 0)->where('end_date', '>=', Carbon::today()->toDateString())->first();
        $deleteVacation = Vacation::all()->where('job_id', '=', $employee->job_id)->where('request_status', '<>', 0)->where('end_date', '<', Carbon::today())->first();
        if (isset($vacation) && $vacation->request_status == 4) {
            $vacation->delete();
            return redirect()->route('vacation')->withErrors(['vacation' => trans('translate.vacation_denied')]);
        } elseif (isset($deleteVacation) && $deleteVacation->request_status != 3 && Carbon::today()->greaterThan($deleteVacation->end_date)) {
            $deleteVacation->delete();
            return redirect()->route('vacation')->withErrors(['vacation' => trans('translate.vacation_deleted')]);
        }
        return view('vacation', compact('employee', 'vacation'));
    }


    public function makeRequest(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $employee = User::where('job_id', $request->job_id)->first();
        $HR_manager = User::where('role', 12)->first();
        $requestVacation = $request->all();
        $requestVacation['head_id'] = $employee->manager_id;

        if ($employee->manager_id == 2 || $employee->manager_id == 241 || $employee->manager_id == $HR_manager->job_id) {
            $requestVacation['request_status'] = 2;
        } else {
            $requestVacation['request_status'] = 1;
        }
        Vacation::create($requestVacation);

        // dd($requestVacation);

        return redirect()->route('vacation');
    }


    public function showAll(Request $request)
    {
        $employee = Auth::user();
        $HR_manager = User::where('role', 12)->first();
        // dd($employee->job_id);

        if (isset($HR_manager) && $employee->job_id == $HR_manager->job_id) {
            $vacationRequests = Vacation::all()->where('request_status', '=', 2);
        } else {
            $vacationRequests = Vacation::all()->where('head_id', '=', $employee->job_id)->where('request_status', '=', 1);
        }

        return view('allVacations', compact('vacationRequests'));
    }

    public function deleteRequest($id)
    {
        $vacation = Vacation::find($id)->delete();
        return redirect()->route('vacation');
    }

    public function accept($id)
    {
        $employee = Auth::user();
        $HR_manager = User::where('role', 12)->first();
        $vacation = Vacation::find($id);

        if ($employee->job_id == $HR_manager->job_id) {
            $vacation->request_status = 3;
        } else {
            $vacation->request_status = 2;
        }
        $vacation->save();
        return back();
    }

    public function deny($id)
    {
        $vacation = Vacation::find($id);
        $vacation->request_status = 4;
        $vacation->save();
        return back();
    }
}
