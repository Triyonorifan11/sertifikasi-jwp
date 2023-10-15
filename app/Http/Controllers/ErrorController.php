<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    //
    public function no_access()
    {
        return view('layouts.error', [
            'status_code' => 403,
            'title' => 'No Access',
            'message' => 'You have no access to this page'
        ]);
    }
}
