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
        @endif
        @error('user_id')
        {{$message}}
        @enderror
    </p>
    <div class="content__timestamp">
        {{-- @if($isWorking) --}}
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_start" value="{{$date}}">
                <input type="hidden" name="work_end" value="{{$date}}">
                <button type="submit">勤務開始</button>
            </form>
        </div>
        {{-- <button disabled>勤務終了</button> --}}
        {{-- @else --}}
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/update" method="POST">
                @csrf
                @method('put')
                <button type="submit" disabled>勤務終了</button>
            </form>
        </div>
        {{-- <button>勤務開始</button> --}}
        {{-- @endif --}}
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="POST">
                @csrf<button type="submit">休憩開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/update" method="POST">
                @csrf
                @method('put')
                <button type="submit" disabled>休憩終了</button>
            </form>
        </div>
    </div>
</div>
@endsection