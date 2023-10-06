<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __invoke()
    {
        $data = ['logs'=>LogActivity::all('action', 'activity', 'activity_time')];
        return view('log', $data);
    }
}