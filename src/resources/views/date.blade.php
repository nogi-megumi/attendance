@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="date">
        <a class="date--link" href="{{ route('attendance.index', ['date' => $previousDay->format('Y-m-d')]) }}">
            &lsaquo;</a>
        <span class="date--present">{{$date->format('Y-m-d')}}
        </span>
        <a class="date--link" href="{{ route('attendance.index', ['date' => $nextDay->format('Y-m-d')]) }}">
            &rsaquo;</a>
    </div>
    <div class="date__table">
        <table class="date__table--inner">
            <tr>
                <th>名前</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
            @foreach ($attendances as $attendance)
            <tr>
                <td>{{$attendance->user->name}}</td>
                <td>{{$attendance->work_start}}</td>
                <td>{{$attendance->work_end}}</td>
                <td>{{$attendance->break_time}}</td>
                <td>{{$attendance->work_time}}</td>
            </tr>
            @endforeach
        </table>
        <div>
            {{$attendances->appends(request()->query())->links('vendor.pagination.custom')}}
        </div>
    </div>
</div>
@endsection