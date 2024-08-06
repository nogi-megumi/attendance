<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
        // 日付別のデータ一覧
        return view('date');
    }
}
