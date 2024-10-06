@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/users_index.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="common-title">
        ユーザー一覧
    </div>
    <div class="users-table">
        <table class="users-table__inner">
            @foreach ($users as $user)
            <tr class="users-table__row">
                <td class="users-table__td">{{$user->name}}</td>
                <td class="users-table__td">
                    <a href="{{route('attendance.userDetail', $user)}}">詳細</a>
                </td>
            </tr>
            @endforeach
        </table>
        <div>
            {{$users->appends(request()->query())->links('vendor.pagination.custom')}}
        </div>
    </div>
</div>
@endsection