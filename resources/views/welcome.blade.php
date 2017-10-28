@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">Task Manager</h1>
        <p class="lead">This is a simple task management system.
            The project in <a href="https://hexlet.io" target="_blank">Hexlet.io</a>.</p>
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
        <div class="text-center">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-lg dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sign In
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="#">Sign in to a different account</a>
                    <a class="dropdown-item" href="#">Create a new account</a>
                </div>
            </div>
            <a class="btn btn-primary btn-lg" href="#" role="button">Go to Tasks</a>
        </div>
    </div>
@endsection
