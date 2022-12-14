<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController as BaseController;
use App\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'job_id' => 'required|string|unique:users',
            'password' => 'required|min:5',
            'place_of_job' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'password' => 'required'
        ]);


        $credentials = request(['job_id', 'password']);

        if (!Auth::attempt($credentials)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        $user = Auth::user();
        $success['name'] =  $user->name;
        $success['id'] =  $user->id;
        $success['job_id'] =  $user->job_id;
        $success['role'] =  $user->role;
        $success['token'] =  $user->createToken('almatin')->accessToken;

        return $this->sendResponse($success, 'User login successfully.');
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return $this->sendResponse('', 'User login successfully.');
    }

    public function index(Request $request)
    {
        // return response()->json(['user' => $request->user()]);
        // dd($request->all());

        $user = Auth::user();
        $user['manager_name'] = collect(DB::select('select name from users where job_id = ?', [$user->manager_id]))->first()->name;
        return $this->sendResponse($user, 'User Data');
    }


    public function salary(Request $request)
    {
        $user_id = Auth::user()->job_id;
        $salary = Salary::all()->where('job_id', '=', $user_id);
        return $this->sendResponse($salary, 'Salary Data');
    }
}
