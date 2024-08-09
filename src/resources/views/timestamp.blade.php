@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/timestamp.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="content__text">{{Auth::user()->name}}さんお疲れ様です&excl;</h2>
    <div class="content__timestamp">
        {{-- @if($isWorking) --}}
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="">
                @csrf
                <button>勤務開始</button>
            </form>
        </div>
        {{-- <button disabled>勤務終了</button> --}}
        {{-- @else --}}
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/update" method="">
                @csrf<button disabled>勤務終了</button></form>
        </div>
        {{-- <button>勤務開始</button> --}}
        {{-- @endif --}}
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="">@csrf<button>休憩開始</button></form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/update" method="">@csrf<button disabled>休憩終了</button></form>
        </div>
    </div>
</div>
@endsection