<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Font Awesome Icons -->
    <script src="https://use.fontawesome.com/e5f9b75319.js"></script>

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
                    <a class="nav-link {{ Request::path() == 'task' ? 'active' : '' }}" href="{{ route('task.index') }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i> Tasks
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() == 'user' ? 'active' : '' }}" href="{{ route('user.index') }}">
                        <i class="fa fa-users" aria-hidden="true"></i> Users
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle
                        {{ (Request::path() == 'tag' || Request::path() == 'status') ? 'active' : '' }}"
                       id="settings-navbar-dropdown-menu-link"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs" aria-hidden="true"></i> Settings
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="settings-navbar-dropdown-menu-link">
                        <a class="dropdown-item {{ Request::path() == 'status' ? 'active' : '' }}" href="{{ route('status.index') }}">
                            Statuses
                        </a>
                        <a class="dropdown-item {{ Request::path() == 'tag' ? 'active' : '' }}" href="{{ route('tag.index') }}">
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
                    <a href="#" class="nav-link dropdown-toggle {{ Request::path() == 'user.edit' ? 'active' : '' }}"
                       id="app-navbar-dropdown-menu-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="app-navbar-dropdown-menu-link">
                        <a class="dropdown-item {{ Request::path() == 'user.edit' ? 'active' : '' }}"
                           href="{{ route('user.edit', Auth::user()->id) }}">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
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
</body>
</html>
