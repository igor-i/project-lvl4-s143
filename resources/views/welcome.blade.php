<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Welcome</title>

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
<div class="container">
    <p>
    <div class="jumbotron">
        <p>
            @include('flash::message')
        </p>
        <h1 class="display-3">Task Manager</h1>
        <p class="lead">This is a simple task management system.
            The project in <a href="https://hexlet.io" target="_blank">Hexlet.io</a>
            <sup><small><i class="fa fa-external-link" aria-hidden="true"></i></small></sup>.</p>
        <hr class="my-4">
        <p>
            Main features:
        <ul>
            <li>No projects</li>
            <li>No teams</li>
            <li>No roles</li>
        </ul>
        To view tasks in guest mode registration is not required. But in order to create or edit task, you must
        registration and log into the system.
        </p>
        <div>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-lg dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sign In
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="{{ route('login') }}">Sign in to a different account</a>
                    <a class="dropdown-item" href="{{ route('register') }}">Create a new account</a>
                </div>
            </div>
            <a class="btn btn-primary btn-lg" href="{{ route('tasks.index') }}" role="button">Go to Tasks</a>
        </div>
    </div>
    </p>
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
