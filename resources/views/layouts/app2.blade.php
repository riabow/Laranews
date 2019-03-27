<!-- resources/views/layouts/app2.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Сайт новостей</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS и JavaScript -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>

</head>

<body>

<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/list">Сайт новостей </a>
        </div>
        <ul class="nav navbar-nav">

            @if(Auth::guest())
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Регистрация</a></li>
            @else

                <li>
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    Logout
                </a>
                </li>
                <li><a href="#">  вы вошли как <b>{{ @Auth::user()->name }}</b> </a></li>
                <li><a href="/nnew">Добавить новость</a></li>
            @endif

            <li><a href="/list">list Анонсы новостей</a></li>

            <li><a href="/searchform">Поиск новости</a></li>

        </ul>
    </div>
</nav>



<div class="container">
    <nav class="navbar navbar-default">
        <!-- Содержимое Navbar -->
    </nav>
</div>

@yield('content')
</body>
</html>