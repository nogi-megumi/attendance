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
    </p>
    <div class="content__timestamp">
        @if(optional($work)->isnotWorking() && optional($break)->isnotBreaking())
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="POST" class="timestamp-item__form">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_start" value="{{$time}}">
                <button class="timestamp-item__button" type="submit">勤務開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/update" method="POST" class="timestamp-item__form">
                @csrf
                @method('put')
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_end" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>勤務終了</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="POST" class="timestamp-item__form">
                @csrf
                <input type="hidden" name="work_id" value="{{optional($work)->id}}">
                <input type="hidden" name="break_start" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>休憩開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/update" method="POST" class="timestamp-item__form">
                @csrf
                @method('put')
                <input type="hidden" name="work_id" value="{{optional($work)->id}}">
                <input type="hidden" name="break_end" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>休憩終了</button>
            </form>
        </div>

        @elseif (optional($break)->isBreaking())
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="POST" class="timestamp-item__form">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_start" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>勤務開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/update" method="POST" class="timestamp-item__form">
                @csrf
                @method('put')
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_end" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>勤務終了</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="POST" class="timestamp-item__form">
                @csrf
                <input type="hidden" name="work_id" value="{{optional($work)->id}}">
                <input type="hidden" name="break_start" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>休憩開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/update" method="POST" class="timestamp-item__form">
                @csrf
                @method('put')
                <input type="hidden" name="work_id" value="{{optional($work)->id}}">
                <input type="hidden" name="break_end" value="{{$time}}">
                <button class="timestamp-item__button" type="submit">休憩終了</button>
            </form>
        </div>

        @elseif(optional($work)->isWorking() or optional($break)->isnotBreaking())
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="POST" class="timestamp-item__form">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_start" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>勤務開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/update" method="POST" class="timestamp-item__form">
                @csrf
                @method('put')
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_end" value="{{$time}}">
                <button class="timestamp-item__button" type="submit">勤務終了</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="POST" class="timestamp-item__form">
                @csrf
                <input type="hidden" name="work_id" value="{{optional($work)->id}}">
                <input type="hidden" name="break_start" value="{{$time}}">
                <button class="timestamp-item__button" type="submit">休憩開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/update" method="POST" class="timestamp-item__form">
                @csrf
                @method('put')
                <input type="hidden" name="work_id" value="{{optional($work)->id}}">
                <input type="hidden" name="break_end" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>休憩終了</button>
            </form>
        </div>

        @else
        <div class="timestamp-item timestamp--work-start">
            <form action="/" method="POST" class="timestamp-item__form">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_start" value="{{$time}}">
                <button class="timestamp-item__button" type="submit">勤務開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--work-end">
            <form action="/work/update" method="POST" class="timestamp-item__form">
                @csrf
                @method('put')
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="work_end" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>勤務終了</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-start">
            <form action="/break" method="POST" class="timestamp-item__form">
                @csrf
                <input type="hidden" name="work_id" value="{{optional($work)->id}}">
                <input type="hidden" name="break_start" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>休憩開始</button>
            </form>
        </div>
        <div class="timestamp-item timestamp--break-end">
            <form action="/break/update" method="POST" class="timestamp-item__form">
                @csrf
                @method('put')
                <input type="hidden" name="work_id" value="{{optional($work)->id}}">
                <input type="hidden" name="break_end" value="{{$time}}">
                <button class="timestamp-item__button" type="submit" disabled>休憩終了</button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection