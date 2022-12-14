<?php

namespace App\Http\Controllers\api;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class UsersImportController extends BaseController
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

        Excel::import(new UsersImport, $request->file);
        return $this->sendResponse('', 'Excel was successfully uploaded');
    }
}
