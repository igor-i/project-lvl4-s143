<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Font Awesome Icons -->
    <script src="https://use.fontawesome.com/e5f9b75319.js"></script>

    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet"/>

    <!-- Styles -->
    <link rel="stylesheet"
          @if (App::environment() === 'local')
          href="{{ asset('/css/app.css') }}"
          @else
          href="{{ secure_asset('/css/app.css') }}"
          @endif
    >
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-navbar-collapse"
                aria-controls="app-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() == 'tasks' ? 'active' : '' }}" href="{{ route('tasks.index') }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i> Tasks
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() == 'users' ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="fa fa-users" aria-hidden="true"></i> Users
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle
                        {{ (Request::path() == 'tags' || Request::path() == 'statuses') ? 'active' : '' }}"
                       id="settings-navbar-dropdown-menu-link"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs" aria-hidden="true"></i> Settings
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settings-navbar-dropdown-menu-link">
                        <a class="dropdown-item {{ Request::path() == 'statuses' ? 'active' : '' }}" href="{{ route('statuses.index') }}">
                            Statuses
                        </a>
                        <a class="dropdown-item {{ Request::path() == 'tags' ? 'active' : '' }}" href="{{ route('tags.index') }}">
                            Tags
                        </a>
                    </div>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ Request::path() == 'users.edit' ? 'active' : '' }}"
                       id="app-navbar-dropdown-menu-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="app-navbar-dropdown-menu-link">
                        <a class="dropdown-item {{ Request::path() == 'users.edit' ? 'active' : '' }}"
                           href="{{ route('users.edit', Auth::user()->id) }}">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            Your profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" rel="nofollow" data-method="post">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            Logout
                        </a>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container">
        <p>
        @include('flash::message')
        </p>
        <p>
        @yield('content')
        </p>
    </div>
</div>

<!-- Scripts -->
<script
        @if (App::environment() === 'local')
        src="{{ asset('/js/app.js') }}"
        @else
        src="{{ secure_asset('/js/app.js') }}"
        @endif
></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

<script
        @if (App::environment() === 'local')
        src="{{ asset('/js/myscript.js') }}"
        @else
        src="{{ secure_asset('/js/myscript.js') }}"
        @endif
></script>

</body>
</html>
