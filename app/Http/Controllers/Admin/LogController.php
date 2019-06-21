<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserLog;

class LogController extends Controller
{
    public function index()
    {
        $logs = UserLog::latest()->get();

        return view('admin.log.log_index', compact('logs'));
    }
}
