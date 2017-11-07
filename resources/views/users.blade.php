@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <h1 class="display-4">Users</h1>

    <nav class="navbar navbar-light bg-light justify-content-between">
        <span class="input-group-btn"></span>
        <form class="form-inline" method="get" href="{{ route('users.index') }}">
            <div class="input-group">
                <input class="form-control form-control-sm" type="search" placeholder="Search"
                       aria-label="Search" name="name" value="{{ Request::input('name') }}">
                @if(Request::input('name') !== null)
                    <span class="input-group-btn">
                            <a class="btn btn-sm btn-outline-danger" type="button" href="{{ route('users.index') }}">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </a>
                        </span>
                @endif
            </div>

            <input type="submit" class="btn btn-sm btn-outline-secondary ml-sm-2 my-2 my-sm-0"
                   value="Search" data-disable-with="Searching...">
        </form>
    </nav>

    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>email</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $key => $user)
            @php
                $email = preg_replace('/\w/', '*', $user->email, 3);
            @endphp
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>
        <nav aria-label="Users navigation">
            {{ $users->links('vendor/pagination/bootstrap-4') }}
        </nav>
    </p>

    @if ($users->count() == 0)
        <p>...there is no users</p>
    @endif

@endsection
