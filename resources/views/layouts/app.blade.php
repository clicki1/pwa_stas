<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @laravelPWA
</head>
<body>
<div id="app">
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                @can('view', auth()->user())
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="{{ route('index') }}" class="nav-link px-2 text-white">Форма</a></li>
                        <li><a href="{{ route('admin.user.index') }}" class="nav-link px-2 text-white">Пользователи</a>
                        </li>
                        <li><a href="{{ route('admin.product.index') }}" class="nav-link px-2 text-white">Лента</a></li>
                        <li><a href="{{ route('admin.table.index') }}" class="nav-link px-2 text-white">Таблицы</a></li>
                    </ul>
                @endcan
                @if(auth()->user())
                    <div class="d-flex">
                        @if(auth()->user()->active === 'on')

                        <button type="button" class="btn btn-success me-2 active" ><i class="fas fa-user"></i> {{ auth()->user()->name }}</button>
                        @else
                            <button type="button" class="btn btn-danger me-2 active">{{ auth()->user()->name }}</button>
                        @endif
                        <form  action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button id="btn_logout" href="{{route('logout')}}" type="submit" class="btn btn-warning">Выйти</button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </header>

    <main class="py-4">
        @if(auth()->user()->active === 'on')
        @yield('content')
        @else
            <h3 class="p-5 text-danger">Вы не активированный пользователь, обратитесь к администратору</h3>
        @endif

    </main>
    <script>
        var  btn_logout = document.querySelector('#btn_logout');

        btn_logout.onclick = function (){
            btn_logout.innerHTML = `<span class="spinner-border spinner-border-sm"></span>  Выходим..`;
        }
    </script>
</div>
</body>
</html>
