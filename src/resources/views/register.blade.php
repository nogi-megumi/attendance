@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="register-form__heading">会員登録</h2>
    <div class="register-form__inner">
        <form class="register-form__form" action="/register" method="POST">
            @csrf
            <input class="register-form__input" type="text" name="name" value="{{old('name')}}" placeholder="名前">
            <p class="error-message">
                @error('name')
                {{$message}}
                @enderror
            </p>
            <input class="register-form__input" type="mail" name="email" value="{{old('email')}}" placeholder="メールアドレス">
            <p class="error-message">
                @error('email')
                {{$message}}
                @enderror
            </p>
            <input class="register-form__input" type="password" name="password" placeholder="パスワード">
            <input class="register-form__input" type="password" name="password_confirmation" placeholder="確認用パスワード">
            <p class="error-message">
                @error('password')
                {{$message}}
                @enderror
            </p>
            <input class="register-form__button" type="submit" value="会員登録">
        </form>
        <div class="page-switch">
            アカウントをお持ちの方はこちら
            <a class="page-switch__link" href="/login">ログイン</a>
        </div>
    </div>
</div>
@endsection