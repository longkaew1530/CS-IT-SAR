<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function overview()
    {
            return view('report/overview');
             
    }
}
