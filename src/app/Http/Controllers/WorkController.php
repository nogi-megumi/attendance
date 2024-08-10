<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index() {
        // 打刻ページの表示
        return view('timestamp');
    }

    public function store(){
        // 勤務開始の処理
    }

    public function update(){
        // 勤務終了の処理
    }
}
