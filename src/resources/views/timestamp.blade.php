@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/timestamp.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="content__text">{{$user->name}}さんお疲れ様です&excl;</h2>
    <p>
        @if (session('message'))
        {{session('message')}}
        @elseif(session('error'))
        {{session('error')}}
        @endif
    </p>
    <div class="content__timestamp">
        @if($work->isWorking())
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="POST">
                @csrf
                <button type="submit" disabled>勤務開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/{{optional($work)->id}}" method="POST">
                @csrf
                @method('put')
                {{-- <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_start" value="{{$start_time}}">
                <input type="hidden" name="work_end" value="{{$end_time}}"> --}}
                <button type="submit">勤務終了</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="POST">
                @csrf<button type="submit">休憩開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/{{optional($break)->id}}" method="POST">
                @csrf
                @method('put')
                {{-- <input type="hidden" name="user_id" vlue="{{$end_time}}"> --}}
                <button type="submit">休憩終了</button>
            </form>
        </div>
        {{-- @if ($break->isBreaking())
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="POST">
                @csrf
                <button type="submit" disabled>勤務開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/{{optional($work)->id}}" method="POST">
                @csrf
                @method('put')
                <button type="submit">勤務終了</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="POST">
                @csrf<button type="submit" disabled>休憩開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/{{optional($break)->id}}" method="POST">
                @csrf
                @method('put')
                <button type="submit">休憩終了</button>
            </form>
        </div>
        @else
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="POST">
                @csrf
                <button type="submit" disabled>勤務開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/{{optional($work)->id}}" method="POST">
                @csrf
                @method('put')
                <button type="submit">勤務終了</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="POST">
                @csrf<button type="submit">休憩開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/{{optional($break)->id}}" method="POST">
                @csrf
                @method('put')
                <button type="submit" disabled>休憩終了</button>
            </form>
        </div>
        @endif --}}
        {{-- @elseif($work->isWorking())
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="POST">
                @csrf
                <button type="submit" disabled>勤務開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/{{optional($work)->id}}" method="POST">
                @csrf
                @method('put')
                {{-- <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_start" value="{{$start_time}}">
                <input type="hidden" name="work_end" value="{{$end_time}}"> --}}
                {{-- <button type="submit">勤務終了</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="POST">
                @csrf<button type="submit">休憩開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/{{optional($break)->id}}" method="POST">
                @csrf
                @method('put') --}}
                {{-- <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_start" value="{{$start_time}}">
                <input type="hidden" name="work_end" value="{{$end_time}}"> --}}
                {{-- <button type="submit" disabled>休憩終了</button>
            </form> --}}
            {{--
        </div> --}}
        @else
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="POST">
                @csrf
                <button type="submit">勤務開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/{{optional($work)->id}}" method="POST">
                @csrf
                @method('put')
                {{-- <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_start" value="{{$start_time}}">
                <input type="hidden" name="work_end" value="{{$end_time}}"> --}}
                <button type="submit" disabled>勤務終了</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="POST">
                @csrf<button type="submit" disabled>休憩開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/{{optional($break)->id}}" method="POST">
                @csrf
                @method('put')
                {{-- <input type="hidden" name="user_id" vlue="{{$end_time}}"> --}}
                <button type="submit" disabled>休憩終了</button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection