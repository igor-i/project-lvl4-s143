@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <div>
        <h1 class="display-4">Users</h1>

        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>created_at</th>
                <th>updated_at</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $key => $user)
                @php
                    $email = preg_replace('/\w/', '*', $user->email, 5);
                @endphp
                <tr>
                    <th scope="row">{{ $users->firstItem() + $key }}</th>
                    <td>{{ $user->id }}</td>
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

    </div>
</div>
@endsection
