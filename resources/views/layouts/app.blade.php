{{-- @foreach(Session::all() $key => $value)
{
    $_SESSION[$key] = $value;
}
@endforeach --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    @yield('title')

    <!-- Scripts -->
    <script src="{{ asset('bootstrap/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('bootstrap/js/jquery-ui.js')}}"></script>
    <script src="{{ asset('bootstrap/js/slim.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js')}}"></script>
    
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    
    <script src="{{ asset('bootstrap/js/jquery.dataTables.min.js')}}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/jquery-ui.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('bootstrap/css/select2.min.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('bootstrap/css/jquery.dataTables.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    {{ __('HOME') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('サインアップ') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    こんにちは {{ Auth::user()->user_name }} <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile/{{ auth()->user()->user_id }}">{{ __('アカウント') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users') }}">{{ __('ユーザ一覧') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ '商品' }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('submitnew') }}">{{ '新規登録' }}</a>
                                  <a class="dropdown-item" href="{{ route('allproducts') }}">{{ '全商品' }}</a>
                                  {{-- <a class="dropdown-item" href="{{ route('yourproducts') }}">{{ '履歴商品' }}</a> --}}
                                </div>
                              </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ '取引' }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('newtrans')}}">{{ '新規登録' }}</a>
                                  <a class="dropdown-item" href="{{ route('alltrans')}}">{{ '履歴取引' }}</a>
                                </div>
                              </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
