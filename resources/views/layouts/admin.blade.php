<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link href="https://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">


                        <!-- Authentication Links -->

                        @guest('admin')
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item" >
                                <a class="nav-link"  href="{{ route('admin.login.show') }}">管理员登录</a>
                            </li>   
                        </ul>
                        <ul class="navbar-nav ml-auto" style="float: right">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">注册 </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('login') }}">登录</a>
                            </li>
                        </ul>

                        @else
 <ul class="navbar-nav ml-auto" style="float: right">
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">

                                {{ Auth::guard('admin')->user()->name }} 

                            </a>

                            <ul class="dropdown-menu">

                                <li>

                                    <a href="{{ route('admin.logout') }}"

                                       onclick="event.preventDefault();

    document.getElementById('logout-form').submit();">

                                        退出登录

                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">

                                        {{ csrf_field() }}

                                    </form>

                                </li>

                            </ul>

                        </li>

                        @endguest

                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>
