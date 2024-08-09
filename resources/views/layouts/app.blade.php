<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ url('css/milligram.min.css') }}" rel="stylesheet">
        <link href="{{ url('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
        <link href="{{ asset('css/moderator.css') }}" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
        <script type="text/javascript">
            // Fix for Firefox autofocus CSS bug
            // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
        </script>
        <script type="text/javascript" src={{ url('js/app.js') }} defer>
        </script>
    </head>
    <body>
        <main>
            <header>

                <div class="left-section">
                    <h1>ImigraPortugal</h1>
                    <nav>
                        <ul>
                            <li><a class="link" href="{{ url('/') }}"> Home </a> </li>
                            <li><a class="link" href="{{ url('/about') }}"> About</a> </li>
                            <li><a class="link" href="{{ url('/help') }}"> Help </a> </li>
                        </ul>
                    </nav>
                </div>

                <div class="right-section">
                    <nav>
                        <ul>
                @if (Auth::check())
                            {{-- Verify if user is admin --}}
                            @if (Auth::user()->isAdmin())
                                <li><a class="link" href="{{ route('admin.show') }}"> Admin Page </a> </li>
                            @endif
                            <li><a class="link" href="{{ route('profile.show',  ['userId' => Auth::user()->id]) }}"><span>{{ Auth::user()->name }}</span> </a> </li>
                            <li id="notification-dropdown" class="dropdown">
                                <a class="link notification-icon" href="#">
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                </a>
                                <div id="notification-content" class="dropdown-content">
                                    <!-- As notificações serão inseridas aqui -->       
                                </div>
                            </li>
                            <li><a class="link" href="{{ url('/logout') }}"> Logout </a> </li>
                @elseif (Auth::guard('moderator')->check())
                    <li><a class="link" href="{{ route('reports.show') }}"><span>Moderator</span> </a> </li>
                    <li>{{ Auth::guard('moderator')->user()->name }} </li>
                    <li id="notification-dropdown" class="dropdown">
                        <a class="link notification-icon" href="#">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                        </a>
                        <div id="notification-content" class="dropdown-content">
                            <!-- As notificações serão inseridas aqui -->       
                        </div>
                    </li>
                    <li><a class="link" href="{{ url('/logout') }}"> Logout </a> </li>
                @else
                            <li><a class="link" href="{{ url('/login') }}"> Login </a> </li>
                            <li><a class="link" href="{{ url('/register') }}"> Register </a> </li>
                @endif
                        </ul>
                    </nav>
                </div>

            </header>
            <section id="content">
                @yield('content')
            </section>
        </main>
        <footer>
            <p> COPYRIGHT @ LBAW 23123 | FEUP </p>
        </footer>
    </body>
</html>