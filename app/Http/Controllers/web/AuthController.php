<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Hash;
// use Carbon\Carbon;
// use App\User;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'password' => 'required'
        ]);


        $credentials = request(['job_id', 'password']);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors('يوجد خطأ في الرقم الوظيفي او كلمة المرور');
        } else {
            return 'hello';
        }
    }


    public function showRegisterFromExcelForm()
    {
        return view('auth.excelregister');
    }

    public function registerFromExcel(Request $request)
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
            return back()->withErrors('حدث خطأ أثناء رفع الملف .. حاول مجددا');
        }

        Excel::import(new UsersImport, $request->file);
        return $this->sendResponse('', 'Excel was successfully uploaded');
    }
}
