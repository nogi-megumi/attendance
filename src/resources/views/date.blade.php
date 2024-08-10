@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="date">
        <a class="date--link" {{-- href="{{route('attendances.index', ['date' => $date->subDay()->format('Y-m-d')]) }}"
            --}}>
            &lsaquo;</a>
        <span class="date--present">2024-08-04{{-- $date->format('Y-m-d') --}}
        </span>
        <a class="date--link" {{-- href="{{ route('attendances.index', ['date' => $date->addDay()->format('Y-m-d')]) }}"
            --}}>&rsaquo;</a>
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
            <tr>{{-- @foreach ($collection as $item)
                @endforeach --}}
                <td>テスト太郎</td>
                <td>10:00:00</td>
                <td>20:00:00</td>
                <td>00:30:00</td>
                <td>09:30:00</td>
            </tr>
        </table>
        <div>
            {{--ペジネーション
            $attendance->links('vendor.pagination.custom')--}}
        </div>
    </div>
</div>
@endsection