<?php

namespace App\Http\Controllers;

use App\User;
use App\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\api\BaseController;
use Illuminate\Support\Facades\Session;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $user = Auth::user();
        $vacationRequests = null;
        $vacation_denied = null;

        // for managers to accept or deny vacation requests
        if ($user->role >= 10 && $user->role < 12) {
            $vacationRequests = Vacation::all()->where('head_id', '=', $user->job_id)->where('request_status', '=', 1)->take(3);
        } elseif ($user->role == 12) {
            $vacationRequests = Vacation::all()->where('request_status', '=', 2)->take(3);
        }

        // to view vacation request status
        $vacation = Vacation::all()->where('job_id', '=', $user->job_id)->where('request_status', '<>', 0)->where('end_date', '>=', Carbon::today()->toDateString())->first();
        $deleteVacation = Vacation::all()->where('job_id', '=', $user->job_id)->where('request_status', '<>', 0)->where('end_date', '<', Carbon::today())->first();
        if (isset($vacation) && $vacation->request_status == 4) {
            $vacation->delete();
            $vacation_denied = trans('translate.vacation_denied_manager');
        } elseif (isset($vacation) && $vacation->request_status == 5) {
            $deleteVacation->delete();
            $vacation_denied = trans('translate.vacation_denied_HR');
        } elseif (isset($deleteVacation) && $deleteVacation->request_status != 3 && Carbon::today()->greaterThan($deleteVacation->end_date)) {
            $deleteVacation->delete();
            $vacation_denied = trans('translate.vacation_deleted');
        }

        // dd($vacationRequests);
        if ($user->change_password == 1) {
            return view('auth.passwords.resetcustom');
        }

        Session::flash(
            'vacation_denied',
            $vacation_denied
        );
        return view('home', ['user' => $user, 'vacationRequests' => $vacationRequests, 'vacation' => $vacation]);
    }

    public function api()
    {
        $user = Auth::user();
        $user['manager_name'] = collect(DB::select('select name from users where job_id = ?', [$user->manager_id]))->first()->name;
        return $this->sendResponse($user, 'User Data');
    }


    public function upload()
    {
        return view('upload');
    }

    public function resetpassword()
    {
        return view('auth.passwords.resetcustom');
    }

    public function resetPasswordPage(Request $request)
    {
        $id = Auth::user()->job_id;
        $request->validate([
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password'
        ]);
        $employeeEdit = User::all()->where('job_id', '=', $id)->first()->update(['password' => bcrypt($request->password), 'change_password' => 0]);

        session()->flash('success', trans('translate.update_success'));
        return redirect()->route('home');
    }
}
