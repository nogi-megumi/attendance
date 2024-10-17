<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <title>Attendance</title>
</head>

<body>
    <header class="header">
        <p class="header__logo">Atte</p>
        <div class="header__link">
            @if (Auth::check())
            <form class="link__item" action="/" method="GET">
                @csrf<input class="link__button" type="submit" value="ホーム">
            </form>
            <form class="link__item" action="/attendance" method="GET">
                @csrf<input class="link__button" type="submit" value="日付一覧">
            </form>
            <form class="link__item" action="/user" method="GET">
                @csrf<input class="link__button" type="submit" value="ユーザー一覧">
            </form>
            <form class="link__item" action="/logout" method="POST">
                @csrf
                <input class="link__button" type="submit" value="ログアウト">
            </form>
            @endif
        </div>
    </header>
    <main class="main">
        @yield('content')
    </main>
    <footer class="footer">
        <div class="footer__copyright">
            <small>
                Atte,inc.
            </small>
        </div>
    </footer>
</body>

</html>