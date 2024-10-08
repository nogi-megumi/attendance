@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="login-form__heading">ログイン</h2>
    <div class="login-form__inner">
        <form class="login-form__form" action="/login" method="POST">
            @csrf
            <input class="login-form__input" type="mail" name="email" value="{{old('email')}}" placeholder="メールアドレス">
            <p class="error-message">
                @error('email')
                {{$message}}
                @enderror
            </p>
            <input class="login-form__input" type="password" name="password" placeholder="パスワード">
            <p class="error-message">
                @error('password')
                {{$message}}
                @enderror
            </p>
            <input class="login-form__button" type="submit" value="ログイン">
        </form>
        <div class="page-switch">
            アカウントをお持ちでない方はこちら
            <a class="page-switch__link" href="/register">会員登録</a>
        </div>
    </div>
</div>
@endsection